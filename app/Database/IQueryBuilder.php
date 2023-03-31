<?php

declare(strict_types=1);

namespace App\Database;

interface IQueryBuilder{
  public function insert():object;
  public function select(string $paraments):object;
  public function update(string $table):object;
  public function delete():object;
  public function table(string $table):object;
}