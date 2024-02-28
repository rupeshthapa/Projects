<?php 
	class DatabaseTable{
		public $pdo; public $table;
		function __construct($pdo, $table){
			$this->pdo = $pdo;
			$this->table = $table;
		}
		function save($record, $primaryKey=''){
		    try {
		        $this->insert($record);
		    } 
		    catch (Exception $e) {
		        $this->update($record, $primaryKey);
		    }
		}

		function insert($record) {
		    $keys = array_keys($record);
		    $values = implode(', ', $keys);
		    $valuesWithColon = implode(', :', $keys);

		    $query = 'INSERT INTO ' . $this->table . ' (' . $values . ') VALUES (:' . $valuesWithColon . ')';

		    $stmt = $this->pdo->prepare($query);

		    $stmt->execute($record);
		}

		function update($record, $primaryKey){
		    $query = 'UPDATE ' . $this->table. ' SET ';
		    $parameters = [];
		    foreach ($record as $key => $value) {
		         $parameters[] = $key . ' = :'. $key;
		    } 
		    $query .= implode(', ', $parameters);
		    $query .= ' WHERE ' . $primaryKey . ' = :primaryKey';
		    $record['primaryKey'] = $record[$primaryKey];
		    $stmt = $this->pdo->prepare($query);
		    $stmt->execute($record);
		}

		function find($field, $value) {
		        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = :value');
		        $criteria = [
		                'value' => $value
		        ];
		        $stmt->execute($criteria);

		        return $stmt;
		}

		function findAll() {
		        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table );
		        $stmt->execute();
		        return $stmt;
		}

		function delete($field, $value){
		    $stmt = $this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE ' . $field . ' = :value');
		    $criteria = [
		                'value' => $value
		        ];
		        $stmt->execute($criteria);

		        return $stmt;
		}
	}
?>