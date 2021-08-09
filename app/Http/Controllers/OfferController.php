<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Offer;
use App\Models\OfferImage;

class OfferController extends Controller
{
    /**
     * Show all Offers
     *
     * @return Response
     */
    public function index()
    {
    }

    /**
     * Get a single offer
     *
     * @return Response
     */
    public function get($postID)
    {
    }

    /**
     * Creates a new offer
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'prod_name' => ['required', 'string'],
            'prod_qty' => ['required','numeric','gt:0'],
            'qty_type' => ['required', 'string'],
            'category' => ['required', 'string'],
            'date_produced' => ['required','date','before_or_equal:today'], // only accept dates before or today
            'date_expired' => ['required','date','after_or_equal:date_produced'],
            'est_price' => ['required', 'numeric'],
            'post_id' => ['required', 'exists:posts,id']
        ])->validate();

        $newOffer = Offer::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::user()->id,
            'prod_name' => $request->prod_name,
            'prod_qty' => $request->prod_qty,
            'qty_type' => $request->qty_type,
            'date_produced' => $request->date_produced,
            'date_expiree' => $request->date_expired,
            'category' => $request->category,
            'est_price' => $request->est_price,
        ]);

        // check if images are empty
        if($request->filled('offerimg_filepath')){
            $imgPaths = $request->offerimg_filepath;
            
            foreach($imgPaths as $imgPath){
                OfferImage::create([
                    'offer_image_path' => $imgPath,
                    'offer_id' => $newOffer->id,
                ]);
            }

        }

        $request->session()->flash('flash.bannerId', uniqid());
        $request->session()->flash('flash.banner', 'Offer made succesfully!');
        $request->session()->flash('flash.bannerStyle', 'success');

        return redirect()->back()
                    ->with('message', 'Offer Made Successfully.');
    }
  
    /**
     * Update an offer
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        Validator::make($request->all(), [
            'prod_name' => ['required', 'string'],
            'prod_qty' => ['required','numeric','gt:0'],
            'qty_type' => ['required', 'string'],
            'category' => ['required', 'string'],
            'date_produced' => ['required','date','before_or_equal:today'], // only accept dates before or today
            'date_expired' => ['required','date','after_or_equal:date_produced'],
            'est_price' => ['required', 'numeric'],
            'post_id' => ['required', 'exists:posts,id']
        ])->validate();

        Offer::where('id', $id)
        ->update([
            'prod_name' => $request->prod_name,
            'prod_qty' => $request->prod_qty,
            'qty_type' => $request->qty_type,
            'category' => $request->category,
            'date_produced' => $request->date_produced, 
            'date_expiree' => $request->date_expired,
            'est_price' => $request->est_price,
            'post_id' => $request->post_id
        ]);

         // check if images are empty
         if($request->filled('offerimg_filepath')){
            $imgPaths = $request->offerimg_filepath;

            // Delete all images then re-upload
            OfferImage::where('offer_id', $id)->delete();
            
            foreach($imgPaths as $imgPath){
                OfferImage::create([
                    'offer_image_path' => $imgPath,
                    'offer_id' => $id,
                ]);
            }
        }


        $request->session()->flash('flash.bannerId', uniqid());
        $request->session()->flash('flash.banner', 'Offer edited succesfully!');
        $request->session()->flash('flash.bannerStyle', 'success');

        return redirect()->back()
                    ->with('message', 'Offer Made Successfully.');

    }
  
    /**
     * Destroy an offer
     *
     * @return Response
     */
    public function destroy($offerID, Request $request)
    {
        Validator::make($request->all(), [
            'offerID' => ['required']
        ])->validate();

        Offer::destroy($offerID);
        
        $request->session()->flash('flash.bannerId', uniqid());
        $request->session()->flash('flash.banner', "Offer Deleted");
        $request->session()->flash('flash.bannerStyle', 'success');

        return redirect()->back()
                    ->with('message', 'Offer Deleted Successfully.');
    }

    /**
     * Reject an Offer
     *
     * @return Response
     */
    public function rejectOffer($offerID, Request $request){

        Validator::make($request->all(), [
            'offerID' => ['required'],
        ]);

        $offer = Offer::findOrFail($offerID);
        $offer->status = 'rejected';
        $offer->save();

        $request->session()->flash('flash.bannerId', uniqid());
        $request->session()->flash('flash.banner', "Offer Rejected");
        $request->session()->flash('flash.bannerStyle', 'success');

        return redirect()->back()
                    ->with('message', 'Offer Rejected Successfully.');
    }
}
