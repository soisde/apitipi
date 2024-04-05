<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrutor extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'foto'];

    public function Regras(){
        return [
        'nome' => 'required|unique:alunos,nome,'.$this->id.'|min:3',
        // 'foto' => 'required|file|mimes:png,jpg,docx,pdf'
        'foto' => 'required'
    ];
    }

    public function Feedback(){
        return[
            'required' => 'O campo :attribute é obrigatório',
            'foto.mimes' => 'O arquivo deve ser em uma imagem em PNG ou JPG',
            'nome.unique' => 'O nome do aluno ja existe',
            'nome.min' => 'O nome do aluno deve conter mais que 3 caracteres'
        ];
    }
}
