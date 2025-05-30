<?php

namespace App\Interfaces\Services\User;

interface UserServiceInterface
{
    public function index();
    public function show($id);
    public function store($request);
    public function update($request , $id);
    public function destroy($id);
}
