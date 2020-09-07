<?php

namespace App\Http\Controllers;

use App\ShoppingList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\State;
use App\User;
use App\Comment;
use App\Article;


class ShoppingController extends Controller
{
    /**
     * overview of the shoppinglists
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(){
        $shopping_lists = ShoppingList::with(['state','user','volunteer', 'articles','comments'])->get();
        return $shopping_lists;
    }


    /**
     * detail view of one shoppinglist
     * @param Shoppinglist $shoppinglist
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(ShoppingList $shoppingList){
        //find by id is done by passed variable already.. do only need to return the view
        return view('shopping_lists.show', compact('shoppingList'));
    }

    /**
     * detail view of one shoppinglist - return one shopping list by passed id
     * @param $id
     * @return Shoppinglist
     */
    public function findById(string $id):ShoppingList{
        $shoppingList = ShoppingList::where('id', (int)$id)
            ->with(['state','user','volunteer','articles','comments.user'])
            ->first();
        return $shoppingList;
    }

    public function hallo(){
        $shopping_lists = ShoppingList::with(['state','user','volunteer', 'articles','comments'])->get();
        return $shopping_lists;
    }

    /**
     * create a new shoppinglist and save it to db, it is used if a shoppinglist is completely new generated
     * @param Request $request
     * @return JsonResponse
     */
    public function save(Request $request):JsonResponse{
        $request = $this->parseRequest($request);

        //transaction to save the model including all relations of shoppinglist
        DB::beginTransaction();
        try{
            //$shoppingList = ShoppingList::create($request->all());
            //vor authentification shopping_id hardcoded
            $shoppingList = ShoppingList::create(['title'=>$request['title'],
                'until'=>$request['until'],
                'user_id'=>$request['user_id'],
                'state_id'=>1]);

            if (isset($request['articles']) && is_array($request['articles'])) {
                foreach ($request['articles'] as $articleReqVal ) {
                    $article = Article::create([
                        'shopping_list_id'=>$shoppingList->id,
                        'title'=>$articleReqVal['title'],
                        'amount'=>$articleReqVal['amount'],
                        'max_price'=>$articleReqVal['max_price']]);
                    $shoppingList->articles()->save($article);


                }
            }
            //if exist, save message to the shoppinglist
            if (isset($request['comments']) && is_array($request['comments'])) {
                foreach ($request['comments'] as $commentReqVal ) {
                    $comment = Comment::create([
                        'shopping_list_id'=>$shoppingList->id,
                        'text'=>$commentReqVal['text'],
                        'user_id'=>$commentReqVal['user_id']]);
                    $shoppingList->comments()->save($comment);
                }
            }

            DB::commit();
            // return a vaild http response
            return response()->json( $shoppingList , 201 );

        } catch (\Exception $e){
            // rollback all queries
            DB::rollBack();
            return response()->json( "saving shoppingList failed: " . $e ->getMessage(), 420 );
        }
    }

    /**
     * update von der shoppinglist mit allen artikeln, wenn artikel noch nicht gibt einen neuen machen
     * @param Request $request
     * @param string $id, cast to int to search in db
     * @return JsonResponse
     */
    public function update(Request $request, string $id): JsonResponse{
        //transaction to save the model including all relations of shoppinglist
        DB::beginTransaction();
        try{
            $shoppingList = ShoppingList::with(['state','user','articles','comments'])
                ->where('id', (int)$id)->first();
            if($shoppingList!=null){
                $request = $this->parseRequest($request);
                $shoppingList->update($request->all());
                if($request['state']['id'])
                    $shoppingList->update(['state_id'=>$request['state']['id']]);
                if($request['volunteer']['id'])
                    $shoppingList->update(['volunteer_id'=>$request['volunteer']['id']]);
                //if exist, save shoppingitems to the shoppinglist
                if (isset($request['articles']) && is_array($request['articles'])) {
                    //delete all old items that have been remove during update
                    //insert them again based on the request array
                    $shoppingList->articles()->delete();
                    foreach ($request['articles'] as $articleReqVal ) {
                        //only shoppingitems that have been updated are considered
                        $article = Article::firstOrNew([
                            'title'=>$articleReqVal['title'],
                            'amount'=>$articleReqVal['amount'],
                            'max_price'=>$articleReqVal['max_price'],
                        ]);
                        $shoppingList->articles()->save($article);
                    }
                }
                    //if exist, save message to the shoppinglist
                if (isset($request['comments']) && is_array($request['comments'])) {
                        foreach ($request['comments'] as $commentReqVal ) {
                            $comment = Comment::firstOrNew([
                                'shopping_list_id'=>$shoppingList->id,
                                'text'=>$commentReqVal['text'],
                                'user_id'=>$commentReqVal['user_id']]);
                            $shoppingList->comments()->save($comment);
                        }

                }
                $shoppingList->save();
            }
            DB::commit();
            $shoppingListResp = ShoppingList::with(['state','user','articles','comment'])
                ->where('id', (int)$id)->first();
            // return a vaild http response
            return response()->json( $shoppingListResp , 201 );

        } catch (\Exception $e){
            // rollback all queries
            DB::rollBack ();
            return response()->json( "updating shoppingList failed: " . $e ->getMessage(), 420 );
        }
    }

    /**
     * delete the shoppinglist
     * @param string $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function delete(string $id):JsonResponse{
        $shoppingList = ShoppingList::where('id', (int)$id)->first();
        if($shoppingList!=null){
            $shoppingList->delete();
        }else{
            throw new \Exception("shoppingList couldn't be deleted - it does not exist" );
        }

        return response()->json('shoppingList ( id '.$id.' ) successfully deleted' , 200 );
    }

    /**
     * modify / convert values if needed
     * @param Request $request
     * @return Request
     */
    private function parseRequest ( Request $request ) : Request {
        // get date and convert it - its in ISO 8601, e.g. "2018-01-01T23:00:00.000Z"
        $date = new \DateTime ( $request -> until);
        $request [ 'until' ] = $date;
        return $request;
    }





}
