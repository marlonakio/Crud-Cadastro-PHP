<?php $this->layout('layout/template', ['title'=>'Projeto DankiCode']) ?>

<form method="post" action="<?=baseURL();?>/createOrUpdate">
  <div class="row">
    <div class="col-md-8">
      <?= getFlashMessage(); ?>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" name="nome" id="nome" value="<?=!empty($data['name']) ? ($data['name']) : '';?>">
      <input type="hidden" name="id" value="<?= isset($data['id'])?$data['id']:'';?>">
    </div>
    <div class="col-md-4">
      <label for="email">Email</label>
      <input type="email" class="form-control" name="email" id="email" value="<?=!empty($data['email']) ? ($data['email']) : ''; ?>">
    </div>
    <div class="col-md-4">
      <label for="setor">Setor</label>
      <select name="setor" id="setor" class="form-control">
        <option value="">Selecionar</option>
        <?php foreach($sectors as $value): ?>
          <option value="<?= $value['id'];?>"<?= (isset($data['id_sectors']) && $data['id_sectors'] === $value['id'])
          ?'selected="selected"'
          :false?>>
        <?= $value['description'];?></option>
        <?php endforeach;?>
      </select>
    </div>
    <div class="col-md-4 mt-2">
      <button type="submit" value="<?= isset($data['id']) ? 'uptadeUser':'addUser'?>" name="acao" class="btn btn-success">Salvar</button>
    </div>
  </div><!--row-->
</form>

<div class="col-md-12 mt-5">
  <table class="table table-sm table-striped table-hover" id="tabela">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Setor</th>
        <th><i class="fa-regular fa-pen-to-square"></i></th>
        <th><i class="fa-sharp fa-solid fa-trash"></i></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user) : ?>
        <tr>
          <td><?= $user['name']; ?></td>
          <td><?= $user['email']; ?></td>
          <td><?= $user['description']; ?></td>
          <td><a href="<?=baseURL();?>/edit/<?= $user['id']; ?>"><i class="fa-regular fa-pen-to-square"></i></a></td>
          <td><a href="<?=baseURL();?>/del/<?= $user['id']; ?>"><i class="fa-sharp fa-solid fa-trash text-danger"></i></a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table><!--table table-sm-->
</div>

<?php $this->push('scripts') ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
  $('#tabela').dataTable();
</script>
<?php $this->end() ?>