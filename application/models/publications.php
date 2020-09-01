<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Publications extends CI_Model
{

	/* Cada clase es una tabla de la base de datos 
	Campos de la base de datos*/
	public $publication_id;
	public $publication_name;

	public function insert()
	{
		/**Hay que comprobar que el id no este vacio antes de ver
		 * si esta dentro de la tabla*/

		if (($this->publication_id != '') && $this->exists($this->publication_id)) {
			$this->update();
		} else {
			/*nombre de la tabla que hemos creado
			ya sabe que la tabla esta en la db ejempl
			porque se lo hemos dicho en la configuracion*/
			$this->db->insert('publications', $this);

			/*Aquie estamos cogiendo el id asignado automaticamente
			por la base de datos y lo estamos asignando a la variable que tenemos arriba
			Simpre vamos a poner insert_id, aunque el PRIMARY KEY tenga otro nombre*/
			$this->publication_id = $this->db->insert_id();
		}
	}

	public function exists($id)
	{

		/*Aqui publication_id es el nombre del campo de la tabla
		(lo podemos ver en el sqlmyadmin).
		el $id es el argumento que le pasamos */
		$this->db->where('publication_id', $id);

		/**Aqui ponemos el nombre de la tabla */
		$query = $this->db->get('publications');

		return ($query->num_rows() > 0);
	}

	public function update()
	{ }
}
