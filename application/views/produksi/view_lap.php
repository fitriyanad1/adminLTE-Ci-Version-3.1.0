<?php

/*$curYear = date('Y'); 
    $curYear = date('Y'); 
    $nm = $dataNM->nm_perusahaan;*/
    //echo $curYear;
    //echo $nm;
    $pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetMargins(40,40,40) ;
        $pdf->SetTitle('Daftar Perusahaan dengan Status Berproduksi') ;
        $pdf->SetFont('Arial','B',13);
        // mencetak string 
        $pdf->Cell(190,7,'DAFTAR PERUSAHAAN STATUS BERPRODUKSI',0,1,'C');
        $pdf->SetFont('Arial','B',11);
        //$pdf->Cell(190,7,'MINERAL BUKAN LOGAM DAN BATUAN PROVINSI RIAU '.$curYear,0,1,'C');
        // Memberikan space kebawah agar; tidak terlalu rapat

       


/*        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        // mencetak string 
        $pdf->Cell(27,6,'Nama IUP',0,0);
        $pdf->Cell(5,6,':',0,0);
        $pdf->SetFont('Arial','',10);
       
        foreach ($dataIdentitas as $row1){
            $pdf->Cell(27,6,$row1->nm_perusahaan,0,1);
        }
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(27,6,'Nomor SK',0,0);
        $pdf->Cell(5,6,':',0,0);
        $pdf->SetFont('Arial','',10);
       
        foreach ($dataIdentitas as $row1){
             $pdf->Cell(27,6,$row1->nomor_sk,0,1);
        }
         $pdf->SetFont('Arial','B',10);
        $pdf->Cell(27,6,'Kabupaten',0,0);
        $pdf->Cell(5,6,':',0,0);
        $pdf->SetFont('Arial','',10);
       
        foreach ($dataIdentitas as $row1){
             $pdf->Cell(27,6,$row1->nama,0,1);
        }
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(27,6,'Tgl Berlaku',0,0);
        $pdf->Cell(5,6,':',0,0);
        $pdf->SetFont('Arial','',10);
       
        foreach ($dataIdentitas as $row1){
             $pdf->Cell(27,6,$row1->tgl_mulai.' hingga '.$row1->tgl_berakhir,0,1); 
        }*/
        
        $pdf->SetFont('Arial','',10);
        if ($dataProduksi != null){
       
        $pdf->Cell(10,7,'',0,1);

        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(13,6,'NO',1,0,'C');
        $pdf->Cell(80,6,'Nama Perusahaan',1,0,'C');
        $pdf->Cell(27,6,'Komoditas',1,0,'C');
        //$pdf->Cell(27,6,'Status',1,0,'C');
        //$pdf->Cell(27,6,'Jenis Izin',1,0,'C');
        $pdf->Cell(40,6,'Nomor SK',1,0,'C');
        $pdf->Cell(18,6,'Luas',1,0,'C');
        //$pdf->Cell(30,6,'Desa',1,0,'C');
       // $pdf->Cell(30,6,'Kecamatan',1,0,'C');
        //$pdf->Cell(30,6,'Kabupaten',1,0,'C');
        $pdf->Cell(27,6,'Masa Berlaku',1,0,'C');
        $pdf->Cell(27,6,'Masa Berakhir',1,1,'C');
        //$pdf->Cell(35,6,'Keterangan',1,1,'C');
        $pdf->SetFont('Arial','',10);
       
        $no=1;
        foreach ($dataProduksi as $row){
            $pdf->Cell(13,6,$no,1,0,'C');
            $pdf->Cell(80,6,$row->nm_perusahaan,1,0,'C');
            $pdf->Cell(27,6,$row->nm_komoditas,1,0,'C');
            //$pdf->Cell(27,6,$row->status,1,0,'C');
            //$pdf->Cell(27,6,$row->jenis_izin,1,0,'C');
            $pdf->Cell(40,6,$row->nomor_sk,1,0,'C');
            $pdf->Cell(18,6,$row->luas_wilayah.' Ha',1,0,'C');
            //$pdf->Cell(30,6,$row->nm_desa,1,0,'C');
           //$pdf->Cell(30,6,$row->nm_kecamatan,1,0,'C');
            //$pdf->Cell(30,6,$row->nm_kabupaten,1,0,'C');
            $pdf->Cell(27,6,$row->tgl_mulai,1,0,'C');
            $pdf->Cell(27,6,$row->tgl_berakhir,1,1,'C');
            //$pdf->Cell(35,6,$row->ket_bayar,1,1,'C'); 
            $no++;
        }
      }
      else {
        $pdf->Cell(10,10,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->SetTextColor(128, 0, 0) ;
        $pdf->Cell(50,6,'Data perusahaan belum tersedia',0,0,'C');
      }

        $pdf->Output('Daftar-Perusahaan-Berproduksi.pdf', 'I');
?>