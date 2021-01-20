<?php

namespace SIS\Imports;

use SIS\Direccion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DireccionsImport implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow, WithMultipleSheets
{
    public function model(array $row)
    {
        $direccionip= Direccion::where('ipv4',$row['ipv4'])->first();
        if(count( $direccionip)==0){
            return new Direccion([
                'unidad' => $row['unidad'],
                'funcionario' => $row['funcionario'],
                'cargo' => $row['cargo'],
                'ipv4' => $row['ipv4'],
                'nombrepc' => $row['nombrepc'],
                'mac' => $row['mac'],
                'internet' => $row['internet'],
                'sigma' => $row['sigma'],
                'sigep' => $row['internet'],
                'redimpresora' => $row['redimpresora'],
                'observacion' => $row['observacion'],
                'estado' => $row['estado'],
                'user_id' => auth()->id(),
            ]);
        }
    }

    public function sheets(): array
    {
        return [
            //Selecciona la Primera Hoja del Excel y lo Importa
            0 => new DireccionsImport()
        ];
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
