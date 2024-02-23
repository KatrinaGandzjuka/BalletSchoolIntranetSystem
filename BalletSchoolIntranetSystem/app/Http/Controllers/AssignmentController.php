<?php


namespace App\Http\Controllers;

use App\Models\ChildrenCostume;
use App\Models\Costume;
use App\Models\User;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function assignCostume(Request $request, Costume $costume)
    {
        $users = User::where('role_id', 1)->get();

        return view('assign-costume', compact('costume', 'users'));
    }

    public function storeAssignment(Request $request)
    {
        $request->validate([
            'costume_id' => 'required',
            'user_id' => 'required|array',
        ]);

        $costume = Costume::find($request->costume_id);

        if (!$costume) {
            abort(404, 'Costume not found');
        }

        $assigned_at = now();

        foreach ($request->user_id as $userId) {
            ChildrenCostume::create([
                'user_id' => $userId,
                'costume_id' => $costume->id,
                'assigned_at' => $assigned_at,
            ]);
        }

        return redirect()->route('costume.index'); 
    }
}

