<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ClientRepository;
use CodeProject\Services\ClientService;
use Illuminate\Http\Request;

//use CodeProject\Http\Requests;
//use CodeProject\Http\Controllers\Controller;



class ClientController extends Controller
{

    /**
     * @var ClientRepository
     */
    private $repository;

    /**
     * @var ClientService
     */
    private $service;

    /**
     * @param ClientRepository $repository
     * @param ClientService $service
     */
    public function __construct(ClientRepository $repository, ClientService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }



    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->repository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return $this->service->show($id);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->service->delete($id);
    }
}
