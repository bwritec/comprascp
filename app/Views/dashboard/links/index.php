<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<div class="content" style="margin-bottom: 61px;">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3 col-lg-2 home-sidebar">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="<?= base_url() ?>index.php/dashboard">
                            Dashboard
                        </a>
                    </li>

                    <li class="list-group-item">
                        <a href="<?= base_url() ?>index.php/dashboard/favorites">
                            Favoritos
                        </a>
                    </li>
                </ul>

                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="<?= base_url() ?>index.php/dashboard/purchases">
                            Compras
                        </a>
                    </li>

                    <li class="list-group-item">
                        <a href="<?= base_url() ?>index.php/dashboard/sales">
                            Vendas
                        </a>
                    </li>
                </ul>

                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="<?= base_url() ?>index.php/dashboard/address">
                            Endereço
                        </a>
                    </li>

                    <li class="list-group-item">
                        <a href="<?= base_url() ?>index.php/dashboard/contact">
                            Contato
                        </a>
                    </li>
                </ul>

                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="<?= base_url() ?>index.php/dashboard/products">
                            Anúncios
                        </a>
                    </li>

                    <li class="list-group-item">
                        <a href="<?= base_url() ?>index.php/dashboard/sell">
                            Vender
                        </a>
                    </li>
                </ul>

                <?php if (session()->has('user') && session('user.admin') === '1'): ?>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="<?= base_url() ?>index.php/dashboard/categories">
                                Categorias
                            </a>
                        </li>

                        <li class="list-group-item active">
                            <a href="<?= base_url() ?>index.php/dashboard/links">
                                Links
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="col-12 col-md-9 col-lg-10">
                <h1>
                    Lista de Links
                </h1>

                <a class="btn btn-primary mb-3" href="/dashboard/links/create">
                    + Novo Link
                </a>

                <table class="table table-bordered">
                    <tr>
                        <th>
                            ID
                        </th>

                        <th>
                            Nome
                        </th>

                        <th>
                            URL
                        </th>

                        <th>
                            Abrir em Nova Aba ?
                        </th>

                        <th>
                            Ações
                        </th>
                    </tr>

                    <?php if (!empty($links)): ?>
                        <?php foreach ($links as $link): ?>
                            <tr>
                                <td>
                                    <?= $link['id'] ?>
                                </td>

                                <td>
                                    <?= $link['name'] ?>
                                </td>

                                <td>
                                    <a href="<?= $link['url'] ?>" target="<?= $link['open_in_new_window'] ? '_blank' : '_self' ?>">
                                        <?= $link['url'] ?>
                                    </a>
                                </td>

                                <td>
                                    <?= $link['open_in_new_window'] ? 'Sim' : 'Não' ?>
                                </td>

                                <td>
                                    <a href="/dashboard/links/edit/<?= $link['id'] ?>" class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <a href="/dashboard/links/delete/<?= $link['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir?')">
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">
                                Nenhum link encontrado
                            </td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
