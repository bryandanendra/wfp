<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return view('admin.members', ['members' => $members]);
    }

    public function show(Member $member)
    {
        return view('admin.member_detail', ['member' => $member]);
    }

    public function edit(Member $member)
    {
        return view('admin.member_edit', ['member' => $member]);
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'points' => 'numeric'
        ]);

        $member->update($request->all());
        return redirect()->route('members.index')->with('success', 'Member berhasil diperbarui');
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member berhasil dihapus');
    }
} 