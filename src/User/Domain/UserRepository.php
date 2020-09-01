<?php


namespace App\User\Domain;


interface UserRepository
{
    public function getUserByDepartment();
    public function getUserByName();
    public function getAllUsers();
    public function getUsersByDepartmentByName();
}