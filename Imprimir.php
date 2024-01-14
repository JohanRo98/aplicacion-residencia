<?php
require_once(__DIR__ . '/tcpdf/tcpdf.php');
include("../../db.php");

date_default_timezone_set('America/Mazatlan');

class PDF extends TCPDF
{
    private $columnWidths;
    private $headerRowHeight;

    function SetColumnWidths($widths)
    {
        $this->columnWidths = $widths;
    }

    public function Header()
    {
        if ($this->getPage() == 1) {
            $this->SetXY(10, 20);
            $this->SetFont('freeserif', 'B', 16);
            $this->Cell(0, 10, 'Lista de Beneficiarios', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            
            $this->headerRowHeight = $this->GetY();
            $this->SetXY(10, $this->headerRowHeight);
        }
    }

    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, 0, 'C');

        $this->Cell(0, 10, 'Fecha: ' . date('Y-m-d H:i:s'), 0, 0, 'R');
    }

    public function Row($data, $fill)
    {
        $numCols = count($data);

        $rowHeight = 10;
        for ($i = 0; $i < $numCols; $i++) {
            $cellHeight = $this->getFontSize() / $this->k; 
            $rowHeight = max($rowHeight, $cellHeight);
        }

        for ($i = 0; $i < $numCols; $i++) {
            $cellData = $data[$i];
            $this->Cell($this->columnWidths[$i], $rowHeight, $cellData, 1, 0, 'C', $fill);
        }

        $this->Ln();
    }
}

$pdf = new PDF('L', 'mm', 'OFICIO');
$pdf->AddPage();
$pdf->SetFont('freeserif', '', 10);

$sentencia = $conexion->prepare("SELECT * FROM tbl_beneficiarios");
$sentencia->execute();
$lista_tbl_beneficiarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$anchos_columnas = array(
    15, 60, 10, 25, 15, 20, 25, 40, 25, 30
);

$pdf->SetColumnWidths($anchos_columnas);

$pdf->SetXY(10, 40);

$pdf->Row(array(
    'ID', 'Nombre', 'Edad', 'Teléfono', 'Años Pescador', 'Pertenece a Cooperativa',
    'Nombre Cooperativa', 'Sitio de Desembarque', 'Propietario Embarcación', 'Fecha de Ingreso'
), true);

foreach ($lista_tbl_beneficiarios as $registro) {
    $sitiodesembarque = obtenerNombreSitioDesembarque($registro['idsitiodesembarque']);

    $pdf->Row(array(
        $registro['id'],
        $registro['primernombre'] . ' ' . $registro['segundonombre'] . ' ' . $registro['primerapellido'] . ' ' . $registro['segundoapellido'],
        $registro['edad'],
        $registro['telefono'],
        $registro['añospescador'],
        $registro['pertenececooperativa'],
        $registro['nombrecooperativa'],
        $sitiodesembarque,
        $registro['propietarioembarcacion'],
        date('Y-m-d', strtotime($registro['fechadeingreso']))
    ), false);
}

$pdf->Output('lista_beneficiarios.pdf', 'I');

function obtenerNombreSitioDesembarque($idSitioDesembarque)
{
    global $conexion;
    $sentencia = $conexion->prepare("SELECT nombredelsitiodesembarque FROM tbl_sitiosdesembarque WHERE id = ?");
    $sentencia->bindParam(1, $idSitioDesembarque);
    $sentencia->execute();
    $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
    return isset($resultado['nombredelsitiodesembarque']) ? $resultado['nombredelsitiodesembarque'] : '';
}
?>

