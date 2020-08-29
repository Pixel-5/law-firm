<?php


namespace App\Repository\Eloquent;


use App\Client;

class ClientRepository extends AbstractBaseRepository
{

    public function __construct(Client $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return bool|Model
     */
    public function update(int $id, array $attributes): bool
    {
        // TODO: Implement update() method.
    }

    public function findById(int $id)
    {
        $client = $this->find($id);
        $client->load([
            'conveyancing',
            'conveyancing.transaction',
            'conveyancing.transaction.plot',
            'litigation',
        ]);
        return $client;
    }

    public function clients()
    {
        return $this->model->all();
    }

    public function deleteClient(int $id)
    {
        return $this->delete($id);
    }
}
