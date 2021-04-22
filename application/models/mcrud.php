<?php
/**
 * Description of mcrud
 * class ini digunakan untuk melakukan manipulasi  data sederhana
 * dengan parameter yang dikirim dari controller.
 * @author sani oppa
 */
class mcrud extends CI_Model{

    private $primary_key = 'id_user';
    private $table_name = 'user';
   
    // Menampilkan data dari sebuah tabel dengan pagination.
    public function getList($tables,$limit,$page,$by,$sort){
        $this->db->order_by($by,$sort);
        $this->db->limit($limit,$page);
        return $this->db->get($tables);
    }
    
    // menampilkan semua data dari sebuah tabel.
    public function getAll($tables){
    
        return $this->db->get($tables);
    }
    
    // menghitun jumlah record dari sebuah tabel.
    public function countAll($tables){
        return $this->db->get($tables)->num_rows();
    }
    
    // menghitun jumlah record dari sebuah query.
    public function countQuery($query){
        return $this->db->get($query)->num_rows();
    }
    
    //enampilkan satu record brdasarkan parameter.
    public function kondisi($tables,$where)
    {
        $this->db->where($where);
        return $this->db->get($tables);
    }
    //menampilkan satu record brdasarkan parameter.
    public  function getByID($tables,$pk,$id){
        $this->db->where($pk,$id);
        return $this->db->get($tables);
    }
    
    // Menampilkan data dari sebuah query dengan pagination.
    public function queryList($query,$limit,$page){
       
        return $this->db->query($query." limit ".$page.",".$limit."");
    }
    
    public function queryBiasa($query,$by,$sort){
       // $this->db->order_by($by,$sort);
        return $this->db->query($query);
    }
    // memasukan data ke database.
    public function insert($tables,$data){
        $this->db->insert($tables,$data);
    }
    
    // update data kedalalam sebuah tabel
    public function update($tables,$data,$pk,$id){
        $this->db->where($pk,$id);
        $this->db->update($tables,$data);
    }
    
    // menghapus data dari sebuah tabel
    public function delete($tables,$pk,$id){
        $this->db->where($pk,$id);
        $this->db->delete($tables);
    }

    public function getnama() 
    {
        
        $this->db->select('*');
        $this->db->from('pegawai');
        $query = $this->db->get();
        return $query->result();
    
    }
    
    function login($username,$password)
    {
       return $this->db->get_where('users',array('username'=>$username,'password'=>$password));        
    }

    function totalanggaran($id_anggaran)
    {
    $totalanggaran = $this->db->query("SELECT SUM(total_harga) as TOTAL FROM detailanggaran WHERE id_anggaran = '".$id_anggaran."' ")->row();

    return $totalanggaran->TOTAL;
    }

    function realisasi($id_anggaran)
    {
    $totalrealisasi = $this->db->query("SELECT SUM(realisasi_1)+(realisasi_2)+(realisasi_3) as TOTAL FROM anggaran WHERE id_anggaran = '".$id_anggaran."' ")->row();

    return $totalrealisasi->TOTAL;
    }

    function totalsaldo($id_transaksi)
    {
    $totalsaldo = $this->db->query("SELECT SUM(nominal_debet)-SUM(nominal_kredit) as TOTAL FROM transaksi WHERE id_transaksi <= '".$id_transaksi."'")->row();

    return $totalsaldo->TOTAL;
    }

    function totalbelumrealisasi($id_setuju)
    {
    $totalbelumrealisasi = $this->db->query("SELECT SUM(acc) - (SUM(realisasi_1)+SUM(realisasi_2)+SUM(realisasi_3)) as SELISIH FROM anggaran WHERE id_setuju = '".$id_setuju."'")->row();

    return $totalbelumrealisasi->SELISIH;
    }

    function belumrealisasi($id_anggaran)
    {
    $belumrealisasi = $this->db->query("SELECT (acc) - ((realisasi_1)+(realisasi_2)+(realisasi_3)) as SELISIH FROM anggaran WHERE id_anggaran = '".$id_anggaran."'")->row();

    return $belumrealisasi->SELISIH;
    }

    function totalacc($id_setuju)
    {
    $totalacc = $this->db->query("SELECT SUM(acc) as TOTAL FROM anggaran WHERE id_setuju = '".$id_setuju."'")->row();

    return $totalacc->TOTAL;
    }

    function totalrealisasiunit($id_setuju,$unit_id)
    {
    $totalrealisasiunit = $this->db->query("SELECT SUM(realisasi_1)+SUM(realisasi_2)+SUM(realisasi_3) as TOTAL FROM anggaran WHERE id_setuju = '".$id_setuju."' AND unit_id = '".$unit_id."'")->row();

    return $totalrealisasiunit->TOTAL;
    }

    function totalbelumrealisasiunit($id_setuju,$unit_id)
    {
    $totalbelumrealisasiunit = $this->db->query("SELECT (SUM(acc) - (SUM(realisasi_1)+SUM(realisasi_2)+SUM(realisasi_3))) as SELISIH FROM anggaran WHERE id_setuju = '".$id_setuju."' AND unit_id = '".$unit_id."'")->row();

    return $totalbelumrealisasiunit->SELISIH;
    }

    function totalaccunit($id_setuju,$unit_id)
    {
    $totalaccunit = $this->db->query("SELECT SUM(acc) as TOTAL FROM anggaran WHERE id_setuju = '".$id_setuju."' AND unit_id = '".$unit_id."'")->row();

    return $totalaccunit->TOTAL;
    }

    function tagihanall($id_setuju,$bulan,$tahun)
    {
    $tagihanall = $this->db->query("SELECT SUM(acc) - (SUM(realisasi_1)+SUM(realisasi_2)+SUM(realisasi_3)) as TAGIHAN FROM anggaran WHERE id_setuju = '".$id_setuju."' AND bulan_id = '".$bulan."' AND tahun_id = '".$tahun."'")->row();

    return $tagihanall->TAGIHAN;
    }
    function tagihanunit($id_setuju,$bulan,$tahun,$unit_id)
    {
    $tagihanall = $this->db->query("SELECT SUM(acc) - (SUM(realisasi_1)+SUM(realisasi_2)+SUM(realisasi_3)) as TAGIHAN FROM anggaran WHERE id_setuju = '".$id_setuju."' AND bulan_id = '".$bulan."' AND tahun_id = '".$tahun."' AND unit_id = '".$unit_id."'")->row();

    return $tagihanall->TAGIHAN;
    }

    function filter_user(){
        $hasil=$this->db->query("SELECT * FROM user");
        return $hasil;
    }
 
    function get_subkategori($id){
        $hasil=$this->db->query("SELECT * FROM subkategori WHERE subkategori_kategori_id='$id'");
        return $hasil->result();
    }

    public function get() 
    {
        
        $this->db->select('level');

        return $this->db->get($this->table_name)->result();
    
    }

    public function get_by_id($id)
    {
      
        $this->db->where($this->primary_key,$id); 
      
        return $this->db->get($this->table_name)->row();
    
    }

    public function get_klasifikasii($id_klasifikasi)
    {
        $hasil=$this->db->query("SELECT subnama_klasifikasi FROM klasifikasi WHERE id_klasifiaksi=$id_klasifikasi");
        return $hasil->result();
    }

    public function hitungUser()
    {   
        $query = $this->db->get('tbl_users');
        if($query->num_rows()>0)
        {
          return $query->num_rows();
        }
        else
        {
          return 0;
        }
    }

    public function hitungPegawai()
    {   
        $query = $this->db->get('pegawai');
        if($query->num_rows()>0)
        {
          return $query->num_rows();
        }
        else
        {
          return 0;
        }
    }

    function filterajuan ($jenis_cuti,$status_ajuan)
    {
        $this->db->where("jenis_cuti",$jenis_cuti);
        $this->db->where("status_ajuan",$status_ajuan);
        return $this->db->get("ajuan_cuti");
    }

 }   

?>
