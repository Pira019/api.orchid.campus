<?php
namespace App\Repository\Manager;

use App\Models\User;

class UserRepository {

    public function __construct(public User $model){
        $this->model = $model;
    }

    /** Display a specifique user
     *
     * @param int $userId
     *
     * @return User
    */
    public function findUser($userId)
    {
        return $this->model->select('user_name','email','created_at','profil_id','customer_id')
        ->find($userId)
        ->load(['profil:id,name',
        'customer' => fn($query)=> $query->with('country:id,name')->select('id','name','first_name','sex','residence_contry','phone','birth_date')]);
    }

}

