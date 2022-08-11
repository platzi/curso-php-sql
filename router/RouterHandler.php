<?php

namespace Router;

class RouterHandler {

    protected $method;
    protected $data;

    public function set_method($method) {
        $this->method = $method;
    }

    public function set_data($data) {
        $this->data = $data;
    }

    public function route($controller, $id) {

        $resource = new $controller();

        switch($this->method) {

            case "get":
                if ($id && $id == "create")
                    $resource->create();
                else if($id)
                    $resource->show($id);
                else
                    $resource->index();
                break;

            case "post":
                $resource->store($this->data);
                break;

            case "delete":
                $resource->delete($id);
                break;

        }

    }
    
}
