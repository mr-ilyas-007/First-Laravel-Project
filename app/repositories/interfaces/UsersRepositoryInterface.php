<?php
namespace App\Repositories\interfaces;

interface UsersRepositoryInterface{
    public function all();
    public function store($data);
    public function edit($id);
    public function update($data, $id);
    public function delete($id);
}
