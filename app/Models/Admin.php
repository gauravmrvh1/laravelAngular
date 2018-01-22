<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Admin extends Model
{
    public static function getAdminDetail( $adminId = null ,$email = null , $password = null ) {
    	$data = DB::table( 'admin' );
		if( !empty($adminId) ) {
			$data = $data->where( [ 
			  'admin.id' => $adminId
			]);
		}
 		if( !empty($email) ) {
			$data = $data->where( [ 
			  'admin.email' => $email
			]);
		}
		if( !empty($password) ) {
			$data = $data->where( [ 
		  'admin.password' => $password
		]);
		}
    	$data = $data->where('status',1)->first();
   	return $data;
    }

    public static function updateAdminDetail( $AdminDetail , $adminId){
        DB::table('admin')
            ->where('id' , $adminId)
            ->update( $AdminDetail );
        return 1;
    }

    public static function checkInterestExsistance( $interestName = null , $interestId = null )
    {
        $data = DB::table('interest');
                if( !empty( $interestName )) {
                    $data = $data->where( ['name' => $interestName] );   
                }
                if( !empty( $interestId )) {
                    $data = $data->where( ['id' => $interestId] );   
                }
        $data = $data->first();
        return $data;
    }

    public static function checkSubInterestExsistance( $SubinterestName = null , $SubinterestId = null ) {

        $data = DB::table('subInterest');
                
                if( !empty( $SubinterestName )) {
                   
                    $data = $data->where( ['subInterest.subInterestName' => $SubinterestName] );   
                }

                if( !empty( $SubinterestId )) {
                   
                    $data = $data->where( ['subInterest.id' => $SubinterestId] );   
                }
        $data = $data->first();
        return $data;
    }

    public static function getInterestList() {

    	$data = DB::table('interest')
		    		->where( [ 'status' => 1 ] )
                    ->select( 'interest.id as id' , 'interest.name as name' )
		    		->get();
		return $data;
    }

    public static function insertInterest( $interestName ) {

    	return DB::table( 'interest' )
    			   ->insert( $interestName);
    }

    public static function updateInterest( $data , $interestId ) {

    	return DB::table( 'interest' )
    			  ->where( [ 'interest.id' => $interestId ] )
    			  ->update( $data );
    }

    public static function updateSubInterest( $data , $SubinterestId ) {

        return DB::table( 'subInterest' )
                  ->where( [ 'subInterest.id' => $SubinterestId ] )
                  ->update( $data );
    }


    public static function checkSubinterestUnderInterest( $interestId ) {

    	$data = DB::table( 'subInterest' )
    			->where( [ 'interestId' => $interestId] )
    			->count();

    	return $data;
    }

    public static function deleteInterest( $interestId ) {

    	return DB::table( 'interest' )
    			->where( [ 'interest.id' => $interestId ] )
    			->delete();

    }

    public static function insertSubInterest( $data ) {

        return DB::table( 'subInterest' )
                  ->insert( $data );
    }

    public static function checkSubinterestUnderInterestId( $InterestId , $subInterestName ) {

        $data = DB::table( 'subInterest' )
                    ->where( [ 'interestId'      => $InterestId ,
                               'subInterestName' => $subInterestName
                             ] )
                    ->first();
        return $data;
    }

    public static function getSubInterestUnderInterestId( $InterestId ) {

        $data = DB::table( 'subInterest' )
                    ->join( 'interest' , 'subInterest.interestId' , '=' , 'interest.id' )
                    ->where( [ 'subInterest.interestId' => $InterestId,
                               'subInterest.status' => 1
                             ] )
                    ->select( 'interest.id as interestId' , 'interest.name as interestName' , 'subInterest.id as subInterestId' , 'subInterest.subInterestName as subInterestName')
                    ->get();
        return $data;

    }

    public static function checkSubinterestUnderUserSubInterest( $SubInterestId ) {

        $data = DB::table( 'userSubInterest' )
                    ->where( [ 'subInterestId' => $SubInterestId ] )
                    ->first();
        return $data;
    }

    public static function deleteSubInterest( $SubInterestId ) {

        $del = DB::table( 'subInterest' )
                    ->where( [ 'subInterest.id' => $SubInterestId] )
                    ->delete();
        return $del;
    }

    

    
}
