<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('match');
    }
    public function store(Request $request)
{
    $filename = uniqid() . '.' . $request->image->extension();
    $request->image->move(public_path('images'), $filename);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'image' => $filename,
    ]);

    return redirect()->back()->with('success', 'User saved');
}
public function users()
{
    return view('users');
}
public function match(Request $request)
{
    $uploaded = $request->file('scan_image');
    $uploadedPath = public_path('scan/' . $uploaded->getClientOriginalName());
    $uploaded->move(public_path('scan'), $uploaded->getClientOriginalName());

    $scriptPath = base_path('python/face_match.py');

    $command = escapeshellcmd("python $scriptPath $uploadedPath");
    $output = shell_exec($command);

    $matchedFilename = trim($output);

    if ($matchedFilename === 'not_found') {
        return redirect()->back()->with('error', 'No match found');
    }

    $user = User::where('image', $matchedFilename)->first();

    // ✅ Show user info in a view
    return view('match', compact('user'));
}


public function face()
{
    return view('face_matching');
}
}
