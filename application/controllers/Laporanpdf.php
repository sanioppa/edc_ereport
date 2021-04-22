<?php
Class Laporanpdf extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->library('pdf');
    }
    
    function index(){
        $pdf = new FPDF('p','mm','A4'); //p = portrait
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'KLINIK MATA EDC GROUP',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'JL. VETERAN MIAGAN MOJOAGUNG',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(35,6,'NIK',1,0);
        $pdf->Cell(70,6,'NAMA',1,0);
        $pdf->Cell(27,6,'NO HP',1,0);
        $pdf->Cell(60,6,'TTL',1,1);
        $pdf->SetFont('Arial','',10);
        //$mahasiswa = $this->db->get('mahasiswa')->result();
        //foreach ($mahasiswa as $row){
            $pdf->Cell(35,6,'3517101309960001',1,0);
            $pdf->Cell(70,6,'ARIFTSANI ROSYADI',1,0);
            $pdf->Cell(27,6,'088217068581',1,0);
            $pdf->Cell(60,6,'JOMBANG, 13 SEPTEMBER 1996',1,1); 
        //}
        $pdf->Output();
    }
}