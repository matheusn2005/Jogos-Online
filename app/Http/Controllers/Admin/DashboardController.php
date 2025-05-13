<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produto;
use App\Models\Venda;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $clientesCount = User::count(); 
        $produtosCount = Produto::count();
        $adminsCount = Admin::count();

        // Função genérica para montar dados mensais
        $montarSerie = function ($model) {
            $dados = $model::select(DB::raw('MONTH(created_at) as mes'), DB::raw('COUNT(*) as total'))
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->get();

            $valores = [];
            for ($i = 1; $i <= 12; $i++) {
                $valores[] = $dados->firstWhere('mes', $i)->total ?? 0;
            }
            return $valores;
        };

        $meses = [];
        for ($i = 1; $i <= 12; $i++) {
            $meses[] = Carbon::create()->month($i)->locale('pt_BR')->translatedFormat('F');
        }

        return view('admin.dashboard', [
            'clientesCount' => $clientesCount,
            'produtosCount' => $produtosCount,
            'adminsCount' => $adminsCount,
            'meses' => $meses,
            'vendasMensais' => $montarSerie(Venda::class),
            'clientesMensais' => $montarSerie(User::class),
            'produtosMensais' => $montarSerie(Produto::class),
            'adminsMensais' => $montarSerie(Admin::class),
        ]);
    }
}
