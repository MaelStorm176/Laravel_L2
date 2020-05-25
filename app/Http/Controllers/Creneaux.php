<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class Creneaux extends Controller
{
    public function index(Request $request){
        $jour = $request['jour'];
        if($request['jour']=='Choisir un jour'){
            return back()->with('erreur','Vous devez choisir un jour de la semaine');
        }
        $jourv=DB::table('creneaux_config')->select('jour')->get();
        $global2=DB::table('creneaux_config')->select('jour','livreur_matin')->get();
        $global=DB::table('creneaux_config')->where('jour','=',$jour)->get();
        $table_creneaux = DB::table('creneaux')
        ->select('id','creneaux','jour','client')
        ->where('client', '=', Auth::user()->id)
        ->orderBy('jour','asc')
        ->get();
        if (empty($request['jour']) || $request['jour'] != $jourv){
            $creneau_get = DB::table('creneaux')->select('creneaux','livreur_matin','livreur_soir')->where('jour','=','lundi')->get();
            $creneau_livreur = DB::table('creneaux_config')->select('livreur_matin','livreur_soir')->where('jour','=','lundi')->get();

            if($creneau_livreur ==NULL){
                $creneau_livreur_matin = $creneau_livreur[0]->livreur_matin;
                $creneau_livreur_soir = $creneau_livreur[0]->livreur_soir;
                $deb_matin ='Fe';
                $fin_matin ='Fe';
                $deb_soir ='Fe';
                $fin_soir = 'Fe';
                return view('creneaux',compact('creneau_livreur_soir','creneau_livreur_matin','global2','creneau_get','jour','deb_matin','fin_matin','deb_soir','fin_soir', 'table_creneaux'));

            }

        }
        else{
            if($global->isEmpty()){
                abort(404);
            }
        }

        if (isset($request['jour'])){
            $creneau_get = DB::table('creneaux')->select('creneaux','livreur_matin','livreur_soir')->where('jour','=',$jour)->get();
            $creneau_livreur = DB::table('creneaux_config')->select('livreur_matin','livreur_soir')->where('jour','=',$jour)->get();
            $creneau_livreur_matin = $creneau_livreur[0]->livreur_matin;
            $creneau_livreur_soir = $creneau_livreur[0]->livreur_soir;
            $deb_matin = $global[0]->deb_matin;
            $fin_matin = $global[0]->fin_matin;
            $deb_soir = $global[0]->deb_soir;
            $fin_soir = $global[0]->fin_soir;
            $tmp = substr($deb_matin,-2);

            $deb_matin = substr($deb_matin, -7, 2);//11 H 00
            if ($tmp == '30'){
                $deb_matin1=30;
            }else{
                $deb_matin1=0;
            }
            $tmp = substr($fin_matin,-2);

            $fin_matin = substr($fin_matin, -7, 2);
            if ($tmp == '30'){
                $fin_matin1=30;
            }else{
                $fin_matin1=0;
            }
            $tmp = substr($deb_soir,-2);

            $deb_soir = substr($deb_soir, -7, 2);
            if ($tmp == '30'){
                $deb_soir1=30;
            }else{
                $deb_soir1=0;
            }
            $tmp = substr($fin_soir,-2);

            if ($tmp == '30'){
                $fin_soir1=30;
            }else{
                $fin_soir1=0;
            }
            $fin_soir = substr($fin_soir, -7, 2);



            return view('creneaux',compact('creneau_livreur_soir','creneau_livreur_matin','jour','creneau_livreur','global2','creneau_get','jour','deb_matin','fin_matin','deb_soir','fin_soir','deb_matin1','fin_matin1','deb_soir1','fin_soir1', 'table_creneaux'));


        }
        else{

            $deb_matin ='Fe';
            $fin_matin ='Fe';
            $deb_soir ='Fe';
            $fin_soir = 'Fe';
            return view('creneaux',compact('creneau_livreur_soir','creneau_livreur_matin','global2','creneau_get','jour','deb_matin','fin_matin','deb_soir','fin_soir', 'table_creneaux'));

        }
    }
    public function reserver(Request $request){
        if(empty($request['creneaux'])){
            return back()->with('erreur','Veuillez selectionner un jour.');
        }
        $test = $request['creneaux'];
        $test = substr($test,-7,2);
        if($test>15){
            $value = DB::table('creneaux')
                ->select('livreur_soir')
                ->where('jour','=',$request['jour'])
                ->where('creneaux','=',$request['creneaux'])
                ->orderBy('id','desc')
                ->value('livreur_soir');
            $value++;
            DB::table('creneaux')
                ->insert(['creneaux'=>$request['creneaux'],'jour'=>$request['jour'],'livreur_soir'=>$value,'client'=>Auth::user()->id]);
        }
        else{
            $value = DB::table('creneaux')
                ->select('livreur_matin')
                ->where('jour','=',$request['jour'])
                ->where('creneaux','=',$request['creneaux'])
                ->orderBy('id','desc')
                ->value('livreur_matin');
            $value++;
            DB::table('creneaux')
                ->insert(['creneaux'=>$request['creneaux'],'jour'=>$request['jour'],'livreur_matin'=>$value,'client'=>Auth::user()->id]);
        }
        return back()->with('message','Votre créneau de '.$request['jour'].' à '.$request['creneaux'].' a bien été réservé');
    }
    public function supprimer(Request $request){
        DB::table('creneaux_config')->select('*')->where('jour','=',$request['supprimer'])->delete();
        DB::table('creneaux')->select('*')->where('jour','=',$request['supprimer'])->delete();

        return back()->with('message','Votre créneau a été supprimé');
    }
    public function reini(Request $request){
        DB::table('creneaux')->select('*')->where('jour','=',$request['reini'])->delete();
        return back()->with('message','Vos créneaux ont été réinitialisé');
    }

    public function supprimer_reservation(Request $request){
        if ($request->ajax()) {
            DB::table('creneaux')->select('*')->where('id', '=', $request['id'])->delete();
        }
        else
        {
            abort(404);
        }
    }

    public function ajouter(Request $request){
        if($request['jour']=='Choisir un jour'){
            return back()->with('erreur','Vous devez choisir un jour de la semaine');

        }

        DB::table('creneaux_config')->updateOrInsert(
            ['jour' => $request['jour']],
            ['jour'=>$request['jour'],
            'deb_matin'=>$request['deb_matin'],
            'fin_matin'=>$request['fin_matin'],
            'deb_soir'=>$request['deb_soir'],
            'fin_soir'=>$request['fin_soir'],
            'livreur_matin'=>$request['livreur_matin'],
            'livreur_soir'=>$request['livreur_soir']
        ]);
        return back()->with('message','Votre créneau à été ajouté');
    }
}
