<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class SettingsController extends Controller
{
    public function index()
    {
        $settings = settings()->all($fresh = true);
        return view('settings.index')->with(compact('settings'));
    }

    public function create()
    {
        return view('settings.create');
    }

    public function store(Request $request)
    {

        settings()->set($request["name"], $request["value"]);
        return redirect()->route('settings.index');
    }
    public function update(Request $request)
    {
        foreach($request->except("_token","_method") as $key => $value)
        {
            echo $key . " " . $value . "<br>";
            settings()->set($key, $value);
        }
        return redirect()->route('settings.index');
    }
    public function destroy($id)
    {
        settings()->remove($id);
        return redirect()->route('settings.index');
    }
}
