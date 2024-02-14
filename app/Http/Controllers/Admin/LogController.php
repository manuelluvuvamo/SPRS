<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logger;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Logg;
use App\Models\Logs;


class LogController extends Controller
{
    public $logSearch;

    public function __construct()
    {
        $logSearch = new Logger();
    }
    public function search()
    {

        $data['years'] = $data['logs'] = DB::table('logs')
            ->selectRaw('YEAR(created_at) as year')->distinct('YEAR(created_at)')->get();

        $data['users'] = $data['logs'] = DB::table('logs')
            ->join('users', 'users.id', '=', 'logs.id_user')
            ->select('users.name', 'users.id')->DISTINCT('logs.id_user')
            ->get();


        return view('admin.logs.search.index', $data);
    }

    public function index(Request $request, Logger $logSearch)
    {

        $datatime = $request->year;
        $user = $request->name;

        $data['datatime'] = $datatime;

        //$data['logs'] =  $logSearch->LogsForSearch($datatime,$user);

        if ($request->name != "null") {
            $data["user"] = User::where("id", $request->name)->get()->first();
            if ($request->filter == "All") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->where("logs.id_user", $request->name)
                    ->get();
            } elseif ($request->filter == "day") {
                # code...

                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->where("logs.id_user", $request->name)->whereDate('logs.created_at', '=', date('Y-m-d'))->get();
                $data["day"] = date('Y-m-d');

            } elseif ($request->filter == "month") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->where("logs.id_user", $request->name)->whereMonth('logs.created_at', '=', date("m", strtotime($request->month)))
                    ->whereYear('logs.created_at', '=', date("Y", strtotime($request->month)))
                    ->get();
                $data["month"] = $request->month;
            } elseif ($request->filter == "year") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->where("logs.id_user", $request->name)->whereYear('logs.created_at', '=', date("Y", strtotime($request->year)))
                    ->get();
                $data["year"] = $request->year;
            } elseif ($request->filter == "date") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->where("logs.id_user", $request->name)->whereDate('logs.created_at', '=', date("Y-m-d", strtotime($request->date)))
                    ->get();
                $data["date"] = $request->date;
            } elseif ($request->filter == "intervalo") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->where("logs.id_user", $request->name)->whereBetween('logs.created_at', [date("Y-m-d", strtotime($request->intervalo1)), date("Y-m-d", strtotime($request->intervalo2))])
                    ->get();
                $data["intervalo1"] = $request->intervalo1;
                $data["intervalo2"] = $request->intervalo2;
            }
        } else {
            if ($request->filter == "All") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")
                    ->get();
            } elseif ($request->filter == "day") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->whereDate('logs.created_at', '=', date('Y-m-d'))->get();

                $data["day"] = date('Y-m-d');
            } elseif ($request->filter == "month") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->whereMonth('logs.created_at', '=', date("m", strtotime($request->month)))
                    ->whereYear('logs.created_at', '=', date("Y", strtotime($request->month)))
                    ->get();

                $data["month"] = $request->month;
            } elseif ($request->filter == "year") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->whereYear('logs.created_at', '=', date("Y", strtotime($request->year)))
                    ->get();

                $data["year"] = $request->year;
            } elseif ($request->filter == "date") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->whereDate('logs.created_at', '=', date("Y-m-d", strtotime($request->date)))
                    ->get();

                $data["date"] = $request->date;
            } elseif ($request->filter == "intervalo") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->whereBetween('logs.created_at', [date("Y-m-d", strtotime($request->intervalo1)), date("Y-m-d", strtotime($request->intervalo2))])
                    ->get();
                $data["intervalo1"] = $request->intervalo1;
                $data["intervalo2"] = $request->intervalo2;
            }

        }
        //dd($data["logs"]);
        if (isset($data["logs"][0])) {
            # code...
            //dd($data["logs"])      
            return view('admin.logs.index', $data);


        } else {

            return redirect()->back()->with("logs.search.print.false", 1);
        }


        return view('admin.logs.index', $data);

    }



    public function searchPrint()
    {
        $data['years'] = $data['logs'] = DB::table('logs')
            ->selectRaw('YEAR(created_at) as year')->distinct('YEAR(created_at)')->get();

        $data['users'] = $data['logs'] = DB::table('logs')
            ->join('users', 'users.id', '=', 'logs.id_user')
            ->select('users.name', 'users.id')->DISTINCT('logs.id_user')
            ->get();
        return view('admin.logs.search.print', $data);
    }

    public function print(Request $request)
    {
        //dd($request);


        /* try { */
        //code...

        if ($request->name != "null") {
            $data["user"] = User::where("id", $request->name)->get()->first();
            //dd($data["user"]);
            if ($request->filter == "All") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->where("logs.id_user", $request->name)
                    ->get();
            } elseif ($request->filter == "day") {
                # code...

                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->where("logs.id_user", $request->name)->whereDate('logs.created_at', '=', date('Y-m-d'))->get();
                $data["day"] = date('Y-m-d');

            } elseif ($request->filter == "month") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->where("logs.id_user", $request->name)->whereMonth('logs.created_at', '=', date("m", strtotime($request->month)))
                    ->whereYear('logs.created_at', '=', date("Y", strtotime($request->month)))
                    ->get();
                $data["month"] = $request->month;
            } elseif ($request->filter == "year") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->where("logs.id_user", $request->name)->whereYear('logs.created_at', '=', date("Y", strtotime($request->year)))
                    ->get();
                $data["year"] = $request->year;
            } elseif ($request->filter == "date") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->where("logs.id_user", $request->name)->whereDate('logs.created_at', '=', date("Y-m-d", strtotime($request->date)))
                    ->get();
                $data["date"] = $request->date;
            } elseif ($request->filter == "intervalo") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->where("logs.id_user", $request->name)->whereBetween('logs.created_at', [date("Y-m-d", strtotime($request->intervalo1)), date("Y-m-d", strtotime($request->intervalo2))])
                    ->get();
                $data["intervalo1"] = $request->intervalo1;
                $data["intervalo2"] = $request->intervalo2;

            }
        } else {
            if ($request->filter == "All") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")
                    ->get();
            } elseif ($request->filter == "day") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->whereDate('logs.created_at', '=', date('Y-m-d'))->get();

                $data["day"] = date('Y-m-d');
            } elseif ($request->filter == "month") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->whereMonth('logs.created_at', '=', date("m", strtotime($request->month)))
                    ->whereYear('logs.created_at', '=', date("Y", strtotime($request->month)))
                    ->get();

                $data["month"] = $request->month;
            } elseif ($request->filter == "year") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->whereYear('logs.created_at', '=', date("Y", strtotime($request->year)))
                    ->get();

                $data["year"] = $request->year;
            } elseif ($request->filter == "date") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->whereDate('logs.created_at', '=', date("Y-m-d", strtotime($request->date)))
                    ->get();

                $data["date"] = $request->date;
            } elseif ($request->filter == "intervalo") {
                # code...
                $data["logs"] = Logs::join('users', "users.id", "=", "logs.id_user")->select("users.*", "logs.*")->whereBetween('logs.created_at', [date("Y-m-d", strtotime($request->intervalo1)), date("Y-m-d", strtotime($request->intervalo2))])
                    ->get();
                $data["intervalo1"] = $request->intervalo1;
                $data["intervalo2"] = $request->intervalo2;
            }

        }

        if (isset($data["logs"][0])) {
            # code...
            //dd($data["logs"]);


            $mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);
            $date = date('d-m-Y');


            $css = file_get_contents("/var/www/html/siteItel/lead23/public/css/bootstrap.min.css");
            $css1 = file_get_contents("/var/www/html/siteItel/lead23/public/css/style.css");
            $data['bootstrap'] = file_get_contents('/var/www/html/siteItel/lead23/public/css/listas/bootstrap.min.css');
            $data['css'] = file_get_contents('/var/www/html/siteItel/lead23/public/css/listas/style.css');

            $html = view("admin.pdfs.relatorios.logs.index", $data);


            try {
                $mpdf->SetHTMLFooter('<h5><div class="text-left">' . $date . '</div></h5>');
                $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
                $mpdf->WriteHTML($css1, \Mpdf\HTMLParserMode::HEADER_CSS);
                //ini_set('max_execution_time', '300');
                //ini_set("pcre.backtrack_limit", "5000000");
                $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
                $mpdf->Output("Relatório de Actividades", "I");
            } catch (\Throwable $th) {
                //throw $th;
                $this->loggerDataError($th->getMessage());
                return redirect()->back()->with("logs.search.print2.false", 1);
            }


        } else {

            return redirect()->back()->with("logs.search.print.false", 1);
        }




        /* } catch (\Throwable $th) {
             //throw $th;
$this->loggerDataError($th->getMessage());
            return redirect()->back()->with("logs.search.print3.false",1);
        } */
    }
}