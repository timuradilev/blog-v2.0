<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CommentsController extends Controller
{
    /**
     * Show the user's comments
     * 
     * @return Illuminate\Http\Response
     */
    public function showUsersComments($userId)
    {
        $user = User::findOrFail($userId);
        return view('pages.userscomments')
            ->with(['userId' => $userId, 'userName' => $user->name, 'action' => 'showComments']);
    }
}
