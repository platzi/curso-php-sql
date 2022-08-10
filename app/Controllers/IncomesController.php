<?php

namespace App\Controllers;

use Database\PDO\Connection;

class IncomesController {

    private $connection;

    public function __construct() {
        $this->connection = Connection::getInstance()->get_database_instance();
    }

    /**
     * Muestra una lista de este recurso
     */
    public function index() {

        $stmt = $this->connection->prepare("SELECT * FROM incomes");
        $stmt->execute();

        $stmt->bindColumn("amount", $amount);
        $stmt->bindColumn("description", $description);

        while($stmt->fetch())
            echo "Ganaste $amount USD en: $description \n";

    }

    /**
     * Muestra un formulario para crear un nuevo recurso
     */
    public function create() {}

    /**
     * Guarda un nuevo recurso en la base de datos
     */
    public function store($data) {

        $stmt = $this->connection->prepare("INSERT INTO incomes (payment_method, type, date, amount, description) VALUES (:payment_method, :type, :date, :amount, :description)");

        $stmt->bindValue(":payment_method", $data["payment_method"]);
        $stmt->bindValue(":type", $data["type"]);
        $stmt->bindValue(":date", $data["date"]);
        $stmt->bindValue(":amount", $data["amount"]);
        $stmt->bindValue(":description", $data["description"]);

        $stmt->execute();

    }

    /**
     * Muestra un único recurso especificado
     */
    public function show() {}

    /**
     * Muestra el formulario para editar un recurso
     */
    public function edit() {}

    /**
     * Actualiza un recurso específico en la base de datos
     */
    public function update() {}

    /**
     * Elimina un recurso específico de la base de datos
     */
    public function destroy($id) {

        $this->connection->beginTransaction();

        // Esto no funciona en MySQL
        // $this->connection->exec("DROP TABLE incomes_test");

        $stmt = $this->connection->prepare("DELETE FROM incomes WHERE id = :id");
        $stmt->execute([
            ":id" => $id
        ]);

        $sure = readline("¿De verdad quieres eliminar este registro? ");

        if ($sure == "no")
            $this->connection->rollBack();
        else
            $this->connection->commit();


    }
    
}

/*

index - Display a listing of the resource.
create - Show the form for creating a new resource.
store - Store a newly created resource in storage.
show - Display the specified resource.
edit - Show the form for editing the specified resource.
update - Update the specified resource in storage.
destroy - Remove the specified resource from storage.

*/