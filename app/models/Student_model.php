<?php

class Student_model extends Model
{
    protected $table = "students";
    protected $primary_key = "id";

    public function count_all_records($search = '')
{
    $sql = "SELECT COUNT(id) as total FROM {$this->table}";
    if (!empty($search)) {
        $sql .= " WHERE lastname LIKE :search1 OR firstname LIKE :search2 OR email LIKE :search3";
        $stmt = $this->db->raw($sql, [
            ':search1' => "%$search%",
            ':search2' => "%$search%",
            ':search3' => "%$search%"
        ]);
    } else {
        $stmt = $this->db->raw($sql);
    }
    return $stmt ? $stmt->fetch(PDO::FETCH_ASSOC)['total'] : 0;
}

public function get_records_with_pagination($limit_clause, $search = '')
{
    $sql = "SELECT * FROM {$this->table}";
    if (!empty($search)) {
        $sql .= " WHERE lastname LIKE :search1 OR firstname LIKE :search2 OR email LIKE :search3";
    }
    $sql .= " ORDER BY id DESC {$limit_clause}";

    $stmt = !empty($search)
        ? $this->db->raw($sql, [
            ':search1' => "%$search%",
            ':search2' => "%$search%",
            ':search3' => "%$search%"
        ])
        : $this->db->raw($sql);

    return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
}


    public function get_all_students()
    {
        return $this->db->table($this->table)->get_all();
    }

    public function get_student($id)
    {
        return $this->db->table($this->table)->where('id', $id)->get();
    }

    public function insert_student($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function update_student($id, $data)
    {
        return $this->db->table($this->table)->where('id', $id)->update($data);
    }

    public function delete_student($id)
    {
        return $this->db->table($this->table)->where('id', $id)->delete();
    }
}
