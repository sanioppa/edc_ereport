<?php
defined('BASEPATH') OR exit('No direct scripts access allowed');

require APPPATH . '/libraries/BaseController.php';

class Ajuancuti extends BaseController
{
	var $folder =   "ajuancuti";
    var $tables =   "ajuan_cuti";
    var $tables2=   "tbl_users";
    var $tables3=   "pegawai";
    var $pk     =   "id_ajuan_cuti";
    var $title  =   "AJUAN CUTI PEGAWAI";

	public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
        $this->load->model('user_model');
        $this->isLoggedIn();   
    }

	public function index()
	{
        $data['record'] =  $this->db->join('pegawai','pegawai.nip=ajuan_cuti.nip_pegawai')->get($this->tables)->result();
        $data['title']  =  $this->title;
        $data['desc']   =  "";
        $data['pk']     =  $this->pk;

        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = 'assets/images/logo_edc.png';
        
        $this->loadViews("page/ajuancuti/view", $this->global, $data , NULL);
        /*$this->load->view('petugas/anggota/view',$data);*/
    }

    public function load_ajuancuti()
    {
        //$jenis_cuti   = $_GET['jenis_cuti'];
        $tahun   = $_GET['tahun'];
        $bulan   = $_GET['bulan'];
        $status_ajuan = $_GET['status_ajuan'];
        if ($tahun == '0' && $bulan == '0' && $status_ajuan == '0') { //SEMUA DATA TAMPIL
            $data = $this->db->join('pegawai','pegawai.nip=ajuan_cuti.nip_pegawai')->get('ajuan_cuti')->result();
        }else if ($status_ajuan == '0' && $bulan == '0' && $tahun != '0') { //BERDASARKAN TAHUN
            $data = $this->db->join('pegawai','pegawai.nip=ajuan_cuti.nip_pegawai')->get_where('ajuan_cuti', ['year(tgl_ajuan)'=>$tahun])->result();
        }else if ($status_ajuan == '0' && $bulan != '0' && $tahun == '0') { //BERDASARKAN BULAN
            $data = $this->db->join('pegawai','pegawai.nip=ajuan_cuti.nip_pegawai')->get_where('ajuan_cuti', ['month(tgl_ajuan)'=>$bulan])->result();
        }else if ($status_ajuan == '0' && $tahun != '0' && $bulan != '0') { //BERDASARKAN TAHUN & BULAN
            $data = $this->db->join('pegawai','pegawai.nip=ajuan_cuti.nip_pegawai')->get_where('ajuan_cuti', ['year(tgl_ajuan)'=>$tahun, 'month(tgl_ajuan)'=>$bulan])->result();
        }else if ($status_ajuan != '0' && $tahun != '0' && $bulan == '0') { //BERDASARKAN TAHUN & STATUS
            $data = $this->db->join('pegawai','pegawai.nip=ajuan_cuti.nip_pegawai')->get_where('ajuan_cuti', ['year(tgl_ajuan)'=>$tahun, 'status_ajuan'=>$status_ajuan])->result();
        }else if ($status_ajuan != '0' && $tahun == '0' && $bulan != '0') { //BERDASARKAN BULAN & STATUS
            $data = $this->db->join('pegawai','pegawai.nip=ajuan_cuti.nip_pegawai')->get_where('ajuan_cuti', ['month(tgl_ajuan)'=>$bulan, 'status_ajuan'=>$status_ajuan])->result();
        }else if ($tahun == '0' && $bulan == '0' && $status_ajuan != '0') { //BERDASARKAN STATUS
            $data = $this->db->join('pegawai','pegawai.nip=ajuan_cuti.nip_pegawai')->get_where('ajuan_cuti', ['status_ajuan'=>$status_ajuan])->result();
        }else{ //BERDASARKAN TAHUN & BULAN & STATUS
            $data = $this->db->join('pegawai','pegawai.nip=ajuan_cuti.nip_pegawai')->get_where('ajuan_cuti', array('year(tgl_ajuan)'=>$tahun,'month(tgl_ajuan)'=>$bulan,'status_ajuan'=>$status_ajuan))->result();
        }
        if (!empty($data)){
            $no=1;
            foreach($data as $r) : ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $r->nama ?></td>
                  <td><?= tgl_indo($r->tgl_ajuan) ?></td>
                  <td><?= date('d-m-Y',strtotime($r->tgl_awal)) ?> s/d <?= date('d-m-Y',strtotime($r->tgl_akhir)) ?></td>
                  <td><?= $r->nama_ajuan ?></td>
                  <?php
                    $start_date = new DateTime($r->tgl_awal);
                    $end_date   = new DateTime($r->tgl_akhir);
                    $interval = $start_date->diff($end_date); 
                  ?>
                  <td><?= $interval->days+1; ?> Hari</td>
                  <td><?= $r->keterangan ?></td>
                  <td><?php
                        if ($r->status_ajuan == 1 ){
                          echo "<span class='label label-info'>Belum Disetujui</span>";
                        } elseif ($r->status_ajuan == 2 ){
                          echo "<span class='label label-success'>Disetujui</span>";
                        } else {
                          echo "<span class='label label-danger'>Ditolak</span>";
                        }
                      ?>
                  </td>
                  <td>
                    <center>
                    <?php
                    $disabled = $r->status_ajuan == 1?'':'disabled';
                    if($this->isAdmin() == FALSE) //ADMIN
                    { ?>
                      <a href="<?=site_url('ajuancuti/edit/'.$r->id_ajuan_cuti);?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                      <a href="<?=site_url('ajuancuti/hapusbyadmin/'.$r->id_ajuan_cuti);?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Hapus?')" title="Hapus"><i class="fa fa-trash"></i></a>
                      <a href="<?=site_url('ajuancuti/lihatpdf/'.$r->id_ajuan_cuti);?>" class="btn btn-primary btn-xs" title="Lihat"><i class="fa fa-eye"></i></a>
                      <a href="<?=site_url('ajuancuti/lihatpdf/'.$r->id_ajuan_cuti);?>" class="btn btn-warning btn-xs" target="_blank" title="Download"><i class="fa fa-download"></i></a>
                      <?php
                    }else{ ?>
                      <a href="<?=site_url('ajuancuti/edit/'.$r->id_ajuan_cuti);?>" class="btn btn-success btn-xs" <?= $disabled ?> title="Edit"><i class="fa fa-edit"></i></a>
                      <button class="btn btn-xs btn-danger" <?= $disabled ?> onclick="return confirm('Yakin Hapus?')"><i class="fa fa-trash"></i></button>
                      <a href="<?=site_url('laporanpdf');?>" class="btn btn-success btn-xs" <?= $disabled ?> title="Edit"><i class="fa fa-edit"></i></a>
                    <?php
                    }
                    ?>
                    </center>
                  </td>
                </tr>
            <?php endforeach; ?> <?php
        }else{
            ?> <tr><td colspan="9" align="center">Tidak ada data</td></tr> <?php
        }
        
    }

    public function historypegawai()
    {
        $data['record'] =  $this->db->
        join('tbl_users','tbl_users.nip=ajuan_cuti.nip_pegawai')->
        where('userId',$this->session->userdata('userId'))->
        get($this->tables)->result();
        $data['title']  =  $this->title;
        $data['desc']   =  "";
        $data['pk']     =  $this->pk;

        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../assets/images/logo_edc.png';
        
        $this->loadViews("page/ajuancuti/viewpegawai", $this->global, $data , NULL);
        /*$this->load->view('petugas/anggota/view',$data);*/
    }

    function tambah()
    {   
        $this->load->model('user_model');
        $data['nama'] = $this->user_model->getNameUser();

        $data['title']      = $this->title;
        $data['desc']       =   "";
        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../assets/images/logo_edc.png';

        $this->loadViews("page/ajuancuti/add", $this->global, $data, NULL);
    }

    function post()
    {
        $data['record'] = $this->db->
            join('tbl_users','tbl_users.nip=pegawai.nip')->
            where('userId',$this->session->userdata('userId'))->
            get($this->tables3)->result();
        
        $data['title']      = $this->title;
        $data['desc']       =   "";
        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../assets/images/logo_edc.png';

        $this->loadViews("page/ajuancuti/post", $this->global, $data, NULL);
    }

    public function post2()
    {

    //$data['id_ajuan_cuti']    = $this->input->post('id_ajuan_cuti',true);
    	$data['nip_pegawai']  = $this->input->post('nip_pegawai',true);
    	$data['jenis_cuti']   = $this->input->post('jenis_cuti',true);
        $data['nama_ajuan']   = $this->input->post('nama_ajuan',true);
        $data['tgl_awal']     = $this->input->post('tgl_awal',true);
        $data['tgl_akhir']    = $this->input->post('tgl_akhir',true);
        $data['keterangan']   = $this->input->post('keterangan',true);
        $data['tgl_ajuan']    = $this->input->post('tgl_ajuan',true);
        $data['alamat_cuti']  = $this->input->post('alamat_cuti',true);
        $data['telp_cuti']    = $this->input->post('telp_cuti',true);

        //$data['userId']           = $this->session->userdata('userId');

        $this->db->insert($this->tables,$data);
        $this->session->set_flashdata('berhasil','Ajuan cuti berhasil dikirim. Silahkan tunggu konfirmasi');
        redirect('ajuancuti/historypegawai');
    }

    public function postbyadmin()
    {

    //$data['id_ajuan_cuti']    = $this->input->post('id_ajuan_cuti',true);
        $data['nip_pegawai']  = $this->input->post('nip_pegawai',true);
        $data['jenis_cuti']   = $this->input->post('jenis_cuti',true);
        $data['nama_ajuan']   = $this->input->post('nama_ajuan',true);
        $data['tgl_awal']     = $this->input->post('tgl_awal',true);
        $data['tgl_akhir']    = $this->input->post('tgl_akhir',true);
        $data['keterangan']   = $this->input->post('keterangan',true);
        $data['tgl_ajuan']    = $this->input->post('tgl_ajuan',true);
        $data['alamat_cuti']  = $this->input->post('alamat_cuti',true);
        $data['telp_cuti']    = $this->input->post('telp_cuti',true);
        //$data['userId']           = $this->session->userdata('userId');

        $this->db->insert($this->tables,$data);
        $this->session->set_flashdata('berhasil','Ajuan cuti berhasil dikirim. Silahkan tunggu konfirmasi');
        redirect('ajuancuti');
    }

    function edit()
    {
        $data['record']  = $this->db->where('id_ajuan_cuti',$this->uri->segment(3))->get($this->tables)->result();
        $data['title']   = $this->title;
        $data['desc']    = "";
        $this->global['pageTitle'] = 'EDC Kepegawaian';
        $this->global['logo']      = '../../assets/images/logo_edc.png';

        $this->loadViews("page/ajuancuti/edit", $this->global, $data, NULL);
    }

    public function update()
    {
        $id  =  $this->input->post('id_ajuan_cuti'); //Mengambil Nilai ID Ajuan Cuti
        $data['jenis_cuti']   = $this->input->post('jenis_cuti',true);
        $data['nama_ajuan']   = $this->input->post('nama_ajuan',true);
        $data['tgl_awal']     = $this->input->post('tgl_awal',true);
        $data['tgl_akhir']    = $this->input->post('tgl_akhir',true);
        $data['keterangan']   = $this->input->post('keterangan',true);
        $data['alamat_cuti']  = $this->input->post('alamat_cuti',true);
        $data['telp_cuti']    = $this->input->post('telp_cuti',true);

        $this->db->where('id_ajuan_cuti',$id)->update($this->tables,$data);
        $this->session->set_flashdata('berhasil','Data berhasil diperbarui');
        redirect('ajuancuti/historypegawai');
    }

    public function updatebyadmin()
    {
        $id  =  $this->input->post('id_ajuan_cuti'); //Mengambil Nilai ID Ajuan Cuti
        $data['jenis_cuti']   = $this->input->post('jenis_cuti',true);
        $data['nama_ajuan']   = $this->input->post('nama_ajuan',true);
        $data['tgl_awal']     = $this->input->post('tgl_awal',true);
        $data['tgl_akhir']    = $this->input->post('tgl_akhir',true);
        $data['keterangan']   = $this->input->post('keterangan',true);
        $data['alamat_cuti']  = $this->input->post('alamat_cuti',true);
        $data['telp_cuti']    = $this->input->post('telp_cuti',true);

        $this->db->where('id_ajuan_cuti',$id)->update($this->tables,$data);
        $this->session->set_flashdata('berhasil','Data berhasil diperbarui');
        redirect('ajuancuti');
    }

    function hapus($pk)
  	{
        $this->db->where('id_ajuan_cuti',$pk)->delete('ajuan_cuti');
        $this->session->set_flashdata('berhasil','Ajuan cuti berhasil di hapus');
        redirect('ajuancuti/historypegawai');
  	}

    function hapusbyadmin($pk)
    {
        $this->db->where('id_ajuan_cuti',$pk)->delete('ajuan_cuti');
        $this->session->set_flashdata('berhasil','Ajuan cuti berhasil di hapus');
        redirect('ajuancuti');
    }

    function lihatpdf()
    {
        $data = $this->db->
        //join('tbl_users','tbl_users.nip=ajuan_cuti.nip_pegawai')->
        join('pegawai','pegawai.nip=ajuan_cuti.nip_pegawai')->
        join('m_perusahaan', 'm_perusahaan.id_perusahaan = pegawai.kode_perusahaan')->
        //join('tbl_roles','tbl_roles.roleId = tbl_users.roleId')->
        where('id_ajuan_cuti',$this->uri->segment(3))->
        get($this->tables)->result();

        foreach ($data as $d) {
            $dnip = $d->nip;
        }

        $datarole = $this->db->
            join('tbl_roles', 'tbl_roles.kode_role = tbl_users.roleId')->
            where('nip',$dnip)->get($this->tables2)->result();

        //foreach ($datarole as $rl) :
        //    $jabatan = $rl->roleId;
        //endforeach;

/*
        foreach ($data as $d) {
            $role = $this->db->
            join('tbl_roles', 'tbl_roles.roleId = tbl_users.roleId')->
            where('nip',$d->nip_pegawai)->get('tbl_users')->result();
        }
*/

        $kop1 = '<b>Head Office :</b> Jl. Raya Veteran 435, Miagan, Mojoagung, Jombang.';
        $kop2 = 'Telp. 0821 4000 1606 , E-mail : <a href="http://www.klinikmataedc.com">edcgroup09@gmail.com</a>';

        $pdf = new FPDF('p','mm','A5'); //p = portrait
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',14);
        foreach ($data as $r) {
        // mencetak string 
        $pdf->Image(base_url().'assets/dist/img/EDC.png',10,7,22,0,'','');
        $pdf->SetLeftMargin(36);
        $pdf->Cell(0,7,'KLINIK MATA EDC GROUP',0,1,'C');
        $pdf->SetLeftMargin(37);
        $pdf->SetFont('Times','',10);
        $pdf->WriteHTML($kop1);
        $pdf->SetLeftMargin(45);
        $pdf->SetFont('Times','',10);
        $pdf->WriteHTML($kop2);
        $pdf->Line(11, 28,137, 28);
        $pdf->Line(11, 28.5,137, 28.5);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetLeftMargin(85);
        $pdf->SetFont('Times','',9);
        $pegawai = $this->db->get('pegawai')->result();
        //foreach ($mahasiswa as $row){
            $pdf->Cell(13,5,'Tanggal',0,0);
            $pdf->Cell(19,5,tgl_bln($r->tgl_ajuan),0,0);
            $pdf->Cell(10,5,'Tahun',0,0);
            $pdf->Cell(10,5,date('Y',strtotime($r->tgl_ajuan)),0,1); 
        //}
        
        //Dibawah Header
        $pdf->SetLeftMargin(0);
        $pdf->Cell(5,0,'',0,1);
        $pdf->SetFont('Times','B',10);
        $pdf->Cell(148.5,3,$r->kode_perusahaan=='HLD'?'FORM CUTI (KARYAWAN HEAD OFFICE)':'FORM CUTI (KARYAWAN KLINIK)',0,0,'C');
        $pdf->SetLeftMargin(10);
        $pdf->Cell(5,3,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(25,5,'Perihal',0,0,'L');
        $pdf->Cell(20,5,': '.ucwords($r->nama_ajuan),0,0,'L');
        $pdf->Cell(5,3,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(148.5,14,'Kepada Yth.',0,0,'L');
        $pdf->Cell(5,7,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(148.5,10,'Manager HRD Klinik Mata EDC Group',0,0,'L');

        $pdf->Cell(5,7,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(148.5,16,'Yang bertanda tangan di bawah ini :',0,0,'L');

        //foreach ($datarole as $rl) { $no=1; $jbtn = $rl->role; }
        //Informasi Cuti
        $pdf->SetLeftMargin(24);
        $pdf->Cell(10,12,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(29,6,'Nama',0,0);
        $pdf->Cell(70,6,': '.ucwords($r->nama),0,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(29,6,'Jabatan',0,0);

        foreach ($datarole as $rl) {
        }
        $pdf->Cell(70,6,': '.$rl->role,0,0);

        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(29,6,'Outlet EDC',0,0);
        $pdf->Cell(70,6,': '.ucwords($r->nama_perusahaan),0,0);

        //Dengan ini . . . . 
        $start_date = new DateTime($r->tgl_awal);
        $end_date   = new DateTime($r->tgl_akhir);
        $interval = $start_date->diff($end_date);
        $hari     = $interval->days+1;
        $pdf->SetLeftMargin(10);
        $pdf->Cell(5,6,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(29,6,'Dengan ini mengajukan cuti tahunan untuk tahun '.date('Y',strtotime($r->tgl_awal)).' selama '.$hari.' hari kerja, terhitung mulai',0,0,'J');
        $pdf->Cell(5,6,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(29,6,'tanggal '.tgl_bln($r->tgl_awal).' s/d '.tgl_bln($r->tgl_akhir).' tahun '.date('Y',strtotime($r->tgl_awal)).'.',0,0);
        $pdf->Cell(5,6,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(29,6,'Alasan saya cuti adalah '.$r->keterangan,0,0);
        $pdf->Cell(5,6,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(29,6,'Selama menjalankan cuti alamat saya adalah di '.ucwords($r->alamat_cuti),0,0);
        $pdf->Cell(5,6,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(29,6,'Dan nomor telepon yang bisa dihubungi '.ucwords($r->telp_cuti),0,0);

        //Demikian...
        $pdf->Cell(5,6,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(148.5,15,'Demikian, permohonan ini saya buat untuk dapat dipertimbangkan sebagaimana mestinya.',0,0,'L');

        $pdf->Cell(5,6,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(46,16,'Mengetahui,',0,0,'C');
        $pdf->Cell(5,6,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(43,14,'Manager HRD',0,0,'C');
        $pdf->Cell(43,14,'Manager Operasional',0,0,'C');
        $pdf->Cell(43,14,'Pemohon',0,0,'C');
        $pdf->Cell(5,12,'',0,1);
        $pdf->Cell(5,6,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(43,14,'( Yessi Ineke )',0,0,'C');
        $pdf->Cell(43,14,'( Beni Setiawan )',0,0,'C');
        $pdf->Cell(43,14,'( '.ucwords($r->nama).' )',0,0,'C');

        $pdf->SetLeftMargin(12);
        $pdf->Cell(5,7,'',0,1);
        $pdf->SetFont('Times','B',10);
        $pdf->Cell(47,16,'Catatan :',0,0,'L');
        $pdf->Cell(5,6,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(47,14,'Hak cuti untuk tahun',0,0,'L');
        $pdf->Cell(45,14,'hari',0,0,'L');
        $pdf->Cell(5,6,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(47,12,'Cuti yang sudah diambil',0,0,'L');
        $pdf->Cell(45,12,'hari',0,0,'L');
        $pdf->Cell(5,6,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(47,10,'Cuti yang belum diambil',0,0,'L');
        $pdf->Cell(45,10,'hari',0,0,'L');
        $pdf->Cell(5,6,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(47,8,'Cuti yang akan diambil',0,0,'L');
        $pdf->Cell(45,8,'hari',0,0,'L');
        $pdf->Cell(5,6,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(47,6,'Sisa cuti tahun',0,0,'L');
        $pdf->Cell(45,6,'hari',0,0,'L');
        $pdf->Cell(5,-24.5,'',0,1);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(55,30.5,'',1,0,'L'); //KOTAK
        }

        $pdf->Output();
    }

}