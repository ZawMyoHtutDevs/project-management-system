<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients_data = Client::when($request->has("name"),function($q)use($request){
            return $q->where("name","like","%".$request->get("name")."%");})
            ->when($request->has("email"),function($q)use($request){
                return $q->where("email","like","%".$request->get("email")."%");})
            ->when($request->has("date"),function($q)use($request){
                    return $q->where("created_at","like","%".$request->get("date")."%");})
            ->paginate(9);
        return view('clients.index', compact('clients_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'email|max:255',
            'asset' => 'mimes:jpeg,png,jpg,gif,svg',
            'phone' => 'regex:/(0)[0-9]/|not_regex:/[a-z]/',
            'address' => 'max:255',
        ]
        ,[
            'name.required' => 'နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'email.email' => 'သင်ထည့်ထားသော အီးမေးကို ပြန်စစ်ပေးပါ။',
            'phone.not_regex' => 'Phone အမှန် ထည့်ပေးရန် လိုအပ်ပါသည်။',
            
        ]
    );

    // edit Main image
    if($request->asset != ''){
        // insert Main Image to local file
        $asset_file = $request->file('asset');
                
        $asset_file->move(public_path().'/backend/images/clients/', $asset_name = rand(1, 1000).time().'.'.$request->asset->extension());
    }

        $client = new Client();
        $client->name = $request->name;
        $client->asset = $asset_name ?? '';
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->contact_person = $request->contact_person;
        $client->website = $request->website;
        $client->address = $request->address;
        $client->description = $request->description;
        $client->save();

        return redirect()->back()->with('success', 'Client အသစ်ကိုထည့်သွင်းပြီးပါပြီ။');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.update', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'email|max:255',
            'asset' => 'mimes:jpeg,png,jpg,gif,svg',
            'phone' => 'regex:/(0)[0-9]/|not_regex:/[a-z]/',
            'address' => 'max:255',
        ]
        ,[
            'name.required' => 'နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'email.email' => 'သင်ထည့်ထားသော အီးမေးကို ပြန်စစ်ပေးပါ။',
            'phone.not_regex' => 'Phone အမှန် ထည့်ပေးရန် လိုအပ်ပါသည်။',
            
        ]
    );

    // edit Main image
    if($request->asset != ''){
            
        // insert Main Image to local file
        $asset_file = $request->file('asset');
        
        $asset_file->move(public_path().'/backend/images/clients/', $asset_name = rand(1, 1000).time().'.'.$request->asset->extension());
        
        
        // Delete old main image
        $del_main_image_path = public_path().'/backend/images/clients/'.$client->asset;
        unlink($del_main_image_path);
    }else{
        $asset_name = $client->asset;
    }

        $client->name = $request->name;
        $client->asset = $asset_name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->contact_person = $request->contact_person;
        $client->website = $request->website;
        $client->address = $request->address;
        $client->description = $request->description;
        $client->save();

        return redirect()->back()->with('success', 'Client - '. $request->name .' - ကိုပြင်ဆင်ပြီးပါပြီ။');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        if(count($client->projects)){
            return redirect()->back()->with('error', "This Client has projects, You can't Delete.");
        }else{

            if($client->asset != ''){
                // Delete old main image
                $del_main_image_path = public_path().'/backend/images/clients/'.$client->asset;
                unlink($del_main_image_path);
            }
            
            $client->delete();

            return redirect()->back()->with('success', 'Client - ပယ်ဖျက်ပြီးပါပြီ။');
        }
    }
}
