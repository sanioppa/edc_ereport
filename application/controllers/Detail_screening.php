<?php
defined('BASEPATH') OR exit('No direct scripts access allowed');

require APPPATH . '/libraries/BaseController.php';

class Detail_screening extends BaseController
{
	var $folder   =   "Detail_screening";
    var $tables   =   "Detail_screening";
    var $tables2  =   "daftar_kasus_screening";
    var $pk       =   "id_detail";
    var $pk2      =   "id_user";
    var $title    =   "DETAIL SCREENING";

	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('url');
        $this->load->library('pagination');
        //$this->load->helper('tgl_indo');
        $this->isLoggedIn();   
    }

	public function index()
	{
        $data['record'] =  $this->db->where('id_detail',$this->uri->segment('2'))
                                    ->join('kegiatan', 'kegiatan.id_kegiatan = detail_screening.id_kegiatan')
                                    /*->join('tbl_roles', 'tbl_roles.kode_role = pegawai.kode_role')*/
                                    ->get($this->tables)->result();

        $data['kasus']  =  $this->db->get($this->tables2)->result();
        //$data['atasan'] =  $this->db->query('SELECT role FROM `tbl_roles` WHERE roleId = 2')->result();
        $data['title']  =  $this->title;

        $data['model']  = $this->user_model->view();

        //$data['outlet'] = $this->user_model->getOutlet();
        //$data['jabatan'] = $this->user_model->getRoles();
        //$data['roles']  = $this->user_model->getJabatan2();

        //

        //

        $this->global['pageTitle'] = 'Detail Screening';
        $this->global['logo']      = 'assets/images/logo_edc.png';
        
        $this->loadViews("page/detail_screening/view", $this->global, $data , NULL);
    }

    public function detailScreening()
	{
        $data['record'] =  $this->db->where('id_detail',$this->uri->segment('3'))
                                    ->join('kegiatan', 'kegiatan.id_kegiatan = detail_screening.id_kegiatan')
                                    /*->join('tbl_roles', 'tbl_roles.kode_role = pegawai.kode_role')*/
                                    ->get($this->tables)->result();

        $data['kasus']  =  $this->db->get($this->tables2)->result();
        //$data['atasan'] =  $this->db->query('SELECT role FROM `tbl_roles` WHERE roleId = 2')->result();
        $data['title']  =  $this->title;

        $data['model']  = $this->user_model->view();

        //$data['outlet'] = $this->user_model->getOutlet();
        //$data['jabatan'] = $this->user_model->getRoles();
        //$data['roles']  = $this->user_model->getJabatan2();

        //

        //

        $this->global['pageTitle'] = 'Detail Screening';
        $this->global['logo']      = 'assets/images/logo_edc.png';
        
        $this->loadViews("page/detail_screening/view", $this->global, $data , NULL);
    }

    public function load_daftar_kasus()
    {
        //$kode_perusahaan = $_GET['kode_perusahaan'];
        $tahun = $_GET['tahun'];
        $bulan = $_GET['bulan'];
        $kode_klasifikasi = $_GET['kode_klasifikasi'];
        if ($tahun == '0' && $bulan == '0' && $kode_klasifikasi == 'ALL') { //SEMUA DATA TAMPIL
            $data = $this->db->order_by('outbox.id_outbox asc')->get($this->tables)->result();
        }elseif ($tahun != '0' && $bulan == '0' && $kode_klasifikasi == 'ALL') { //BERDASARKAN TAHUN
            $data = $this->db->where('year(tgl_terima)',$tahun)->get($this->tables)->result();
        }elseif ($tahun == '0' && $bulan != '0' && $kode_klasifikasi == 'ALL') { //BERDASARKAN BULAN
            $data = $this->db->where('month(tgl_terima)',$tahun)->get($this->tables)->result();
        }elseif ($tahun == '0' && $bulan == '0' && $kode_klasifikasi != 'ALL') { //BERDASARKAN KLASIFIKASI
            $data = $this->db->where('kode_klasifikasi',$kode_klasifikasi)->get($this->tables)->result();
        }elseif ($tahun != '0' && $bulan != '0' && $kode_klasifikasi == 'ALL') { //BERDASARKAN TAHUN DAN BULAN
            $data = $this->db->where('year(tgl_terima)',$tahun)->where('month(tgl_terima)',$bulan)->get($this->tables)->result();
        }elseif ($tahun != '0' && $bulan == '0' && $kode_klasifikasi != 'ALL') { //BERDASARKAN TAHUN DAN KLASIFIKASI
            $data = $this->db->where('year(tgl_terima)',$tahun)->where('kode_klasifikasi',$kode_klasifikasi)->get($this->tables)->result();
        }elseif ($tahun == '0' && $bulan != '0' && $kode_klasifikasi != 'ALL') { //BERDASARKAN BULAN DAN KLASIFIKASI
            $data = $this->db->where('month(tgl_terima)',$tahun)->where('kode_klasifikasi',$kode_klasifikasi)->get($this->tables)->result();
        }else{ //BERDASARKAN SEMUA FILTER
            $data = $this->db->where('year(tgl_terima)',$tahun)->where('month(tgl_terima)',$bulan)->where('kode_klasifikasi',$kode_klasifikasi)->get($this->tables)->result();
        }
        if (!empty($data)){
                $no=1;
                foreach($data as $r) : ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $this->user_model->getOutlet($r->id_user); ?></td>
                  <td><?= tgl_indo($r->tgl_kirim); ?></td>
                  <td><?= $r->no_agenda; ?></td>
                  <td><?= $r->no_surat; ?></td>
                  <td><?= tgl_indo($r->tgl_surat); ?></td>
                  <td><?= $r->isi; ?></td>
                  <td><?= $r->tujuan; ?></td>
                  <td><?= $r->kode_klasifikasi; ?></td>
                  <td>
                        <?php
                        $nilai = $r->keterangan;
                        $hasil = $nilai!="" ? $r->keterangan : 'Tidak ada';
                        echo $hasil;
                        ?>
                  </td>
                  <td>
                    <center>
                    <a href="<?=site_url('outbox/edit/'.$r->id_outbox);?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                    <a href="<?=site_url('outbox/hapus/'.$r->id_outbox);?>" class="btn btn-danger btn-xs alert_hapus" title="Hapus"><i class="fa fa-trash"></i></a>
                    </center>
                  </td>
                </tr>
                  <?php 
                  $no++;
                  endforeach;?>
                    
                    <script>
                        jQuery(document).ready(function($){
                            $('.alert_hapus').on('click',function(){
                            var getLink = $(this).attr('href');
                                swal({
                                title: 'Konfirmasi',
                                text: 'Anda yakin ingin menghapus data ini?',
                                html: true,
                                //confirmButtonColor: '#d9534f',
                                confirmButtonClass: "btn-danger",
                                showCancelButton: true,
                                confirmButtonText: "Hapus",
                                cancelButtonText: "Batal",
                                closeOnConfirm: false,
                                closeOnCancel: true
                                },
                                function(){
                                window.location.href = getLink
                                swal("Sukses!", "Data berhasil dihapus", "success");
                                });
                                return false;
                            });
                        }); 
                    </script>
                  <?php
        }else{
            ?> <tr><td colspan="10" align="center">Tidak ada data</td></tr> <?php
        }
        
    }

    function post()
    {
        $data['record']     =  $this->db->where('id_user != 1')->get($this->tables2)->result();
        //$data['record'] =  $this->db->join('tbl_users','tbl_users.nip=pegawai.nip')->get($this->tables)->result();
        $data['title']      = $this->title;
        $data['desc']       =   "";

        //$this->load->model('user_model');
        //$data['roles'] = $this->user_model->getUserRoles();
        //$data['role'] = $this->user_model->getRoles();
        //$data['outlet'] = $this->user_model->getOutlet();

        $this->global['pageTitle'] = 'TAMBAH SURAT KELUAR BARU';
        $this->global['logo']      = '../assets/images/logo_edc.png';

        $this->loadViews("page/outbox/post", $this->global, $data, NULL);
    }

    function add()
    {
        $data['id_user']           = $this->input->post('id_user',true);
        $data['tgl_kirim']         = $this->input->post('tgl_kirim',true);
        $data['no_agenda']         = $this->input->post('no_agenda',true);
        $data['no_surat']          = $this->input->post('no_surat',true);
        $data['tgl_surat']         = $this->input->post('tgl_surat',true);
        $data['isi']               = $this->input->post('isi',true);
        $data['tujuan']            = $this->input->post('tujuan',true);
        $data['kode_klasifikasi']  = $this->input->post('kode_klasifikasi',true);
        $data['keterangan']        = $this->input->post('keterangan',true);

        $this->db->insert($this->tables,$data);
        //$this->session->set_flashdata('berhasil','Data Surat Keluar berhasil di Tambah');
        redirect('outbox');
    }

    function edit($id)
    {
        $data['outbox']            = $this->db->where('id_outbox',$id)->get('outbox')->result();
        $data['record']            = $this->db->where('id_user != 1')->get($this->tables2)->result();
        $this->global['pageTitle'] = 'EDIT SURAT KELUAR';
        $this->global['logo']      = '../../assets/images/logo_edc.png';

        $this->loadViews("page/outbox/edit", $this->global, $data, NULL);
    }

    public function update()
    {
        $kd = $this->input->post('id_outbox',true);
        
        $data['id_outbox']         = $this->input->post('id_outbox',true);
        $data['id_user']           = $this->input->post('id_user',true);
        $data['tgl_kirim']         = $this->input->post('tgl_kirim',true);
        $data['no_agenda']         = $this->input->post('no_agenda',true);
        $data['no_surat']          = $this->input->post('no_surat',true);
        $data['tgl_surat']         = $this->input->post('tgl_surat',true);
        $data['isi']               = $this->input->post('isi',true);
        $data['tujuan']            = $this->input->post('tujuan',true);
        $data['kode_klasifikasi']  = $this->input->post('kode_klasifikasi',true);
        $data['keterangan']        = $this->input->post('keterangan',true);

        $this->db->where('id_outbox',$kd)->update('outbox',$data);
        $this->session->set_flashdata('berhasil','Data Surat Keluar berhasil diperbarui');

        redirect('outbox');
        
        //if ($this->session->userdata('level') == 'pegawai') {
        //    redirect('pegawai/profil/'.$this->session->userdata('userId'));
        //}else{
        //    redirect('pegawai/detail/'.$this->input->post('nip_pegawai'));
        //}
    }

    function hapus($pk)
  	{
        $this->db->where('id_outbox',$pk)->delete('outbox');
        $this->session->set_flashdata('berhasil','Data berhasil di hapus');
        redirect('outbox');
    }
}
?>