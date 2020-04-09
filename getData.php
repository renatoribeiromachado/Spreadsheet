<?php
    use Illuminate\Database\Capsule\Manager as Capsule;

    $capsule = new Capsule;

    $capsule->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'acessoho_acesso',
        'username'  => 'acessoho_acesso',
        'password'  => 'acessoshow40!@',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ]); 
    $capsule->setAsGlobal();

    function getObras($dataInicial, $dataFinal){
        return Capsule::table(Capsule::raw('tb_obras_obr AS obr'))
        ->select('obr.Atualizacao', 'obr.Publicacao','obr.Projeto', 'obr.Valor')
        ->whereBetween('obr.Atualizacao', [$dataInicial, $dataFinal])
        ->orderBy('obr.id', 'asc')
        ->get();
    }