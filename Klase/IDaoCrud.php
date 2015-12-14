<?php
namespace Dao;

interface IDaoCrud{
    public function create($arg);
    public function read($arg);
    public function update($arg);
    public function delete($arg);
    public function getById($arg);
    public function getAll();
    public function getByExample($name, $value);
}
?>