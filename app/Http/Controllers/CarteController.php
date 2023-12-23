<?php

namespace App\Http\Controllers;

use App\Models\Carte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarteController extends Controller
{
    
    public function storeImage(Request $request)
{
    // Get the base64-encoded image data from the request
    $imageData = $request->input('image_data');

    // Decode the base64-encoded image data
    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));

    // Generate a unique filename for the image
    $filename = 'image_' . time() . '.png';

    // Store the image in the storage/app/public directory
    Storage::disk('public')->put($filename, $imageData);

    // Save the filename or other information in the database as needed
      $carte = new Carte();
      $carte->image = $filename;
    if($carte->save()){
          session()->flash('type', 'alert-success');
          session()->flash('message', 'Image chargé avec succès');
          return redirect('/');      
        
    }
      else{
          	session()->flash('type', 'alert-danger');
			session()->flash('message', 'Une erreur s\'est produite à la création, veuillez réessayer');
			return back();
      }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carte $carte)
    {
        //
    }
}
