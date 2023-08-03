<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Etudiant;

class EtudiantController extends Controller
{
    public function liste_etudiant()
    {
        $etudiants = Etudiant::orderBy('id')->paginate(10);

        foreach ($etudiants as $etudiant) {
            $data = "" . $etudiant->nom . ", " . $etudiant->prenom . ", " . $etudiant->classe;
            $etudiant->qrcode = QrCode::size(80)->generate($data);   
        }

        return view('etudiant.liste', compact('etudiants'));
    }

    public function ajouter_etudiant(Request $request)
    {   
        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
        $classe = $request->input('classe');

        $data = "Nom: " . $nom . ", Prénom: " . $prenom . ", Classe: " . $classe;
        $qrcode = QrCode::size(200)->generate($data);

        return view('etudiant.ajouter', compact('qrcode'));
    }
    public function ajouter_etudiant_traitement(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'classe' => 'required',
        ]);

        $etudiant = new Etudiant();
        $etudiant->nom = $request->nom;
        $etudiant->prenom = $request->prenom;
        $etudiant->classe = $request->classe;
        $etudiant->save();

        return redirect('/etudiant')->with('status', 'L\'etudiant a bien ete ajoute');
    }

    public function update_etudiant($id) {

        $etudiants = Etudiant::find($id);

        return view('etudiant.update', compact('etudiants'));
    }

    public function update_etudiant_traitement(Request $request){
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'classe' => 'required',
        ]);

        $etudiant = Etudiant::find($request->id);
        $etudiant->nom = $request->nom;
        $etudiant->prenom = $request->prenom;
        $etudiant->classe = $request->classe;
        $etudiant->update();

        return redirect('/etudiant')->with('status', 'L\'etudiant a ete modifie avec succes');
    }

    public function delete_etudiant($id){

        $etudiant = Etudiant::find($id);
        $etudiant->delete();

        return redirect('/etudiant')->with('status', 'L\'etudiant a ete supprime avec succes');
    }

    public function generate(){
        
    }
}
