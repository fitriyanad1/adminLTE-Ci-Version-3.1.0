<?php

$curYear = date('Y'); 
    $curYear = date('Y'); 
    $nm = $dataNM->nm_perusahaan;
    //echo $curYear;
    //echo $nm;
    $pdf = new FPDF('p','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetMargins(20,40,20) ;
        $pdf->SetTitle('RekapitulasiProduksi') ;
        $pdf->SetFont('Arial','B',13);
        // mencetak string 
        $pdf->Cell(190,7,'REKAPITULASI PRODUKSI DAN PENJUALAN IZIN USAHA PERTAMBANGAN',0,1,'C');
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(190,7,'MINERAL BUKAN LOGAM DAN BATUAN PROVINSI RIAU '.$curYear,0,1,'C');
        // Memberikan space kebawah agar; tidak terlalu rapat

       


        $pdf->Cell(10,7,'',0,1);
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
        }
        
        $pdf->SetFont('Arial','',10);
        if ($dataKelola != null){
       
        $pdf->Cell(10,7,'',0,1);

        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(13,6,'NO',1,0,'C');
        $pdf->Cell(37,6,'Bulan Produksi',1,0,'C');
        $pdf->Cell(27,6,'Volume (M3)',1,0,'C');
        $pdf->Cell(27,6,'Total Pajak',1,0,'C');
        $pdf->Cell(27,6,'Pajak Bayar',1,0,'C');
        $pdf->Cell(35,6,'Keterangan',1,1,'C');
        $pdf->SetFont('Arial','',10);
       
        $no=1;
        foreach ($dataKelola as $row){
            $pdf->Cell(13,6,$no,1,0,'C');
            $pdf->Cell(37,6,$row->bulan_produksi,1,0,'C');
            $pdf->Cell(27,6,$row->volume.' m3',1,0,'C');
            $pdf->Cell(27,6,'Rp.'.$row->total_pajak,1,0,'C');
            $pdf->Cell(27,6,'Rp.'.$row->pajak_bayar,1,0,'C');
            $pdf->Cell(35,6,$row->ket_bayar,1,1,'C'); 
            $no++;
        }
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(50,6,'Total',1,0,'C');
        foreach ($dataJumlah as $row){
             $pdf->Cell(27,6,$row->volume.' m3',1,0,'C');
             $pdf->Cell(27,6,'Rp.'.$row->total,1,0,'C');
             $pdf->Cell(27,6,'Rp.'.$row->bayar,1,0,'C');
             $pdf->SetTextColor(128, 0, 0) ;
             $pdf->Cell(35,6,'Rp.'.$row->hutang,1,0,'C');
        }
      }
      else {
        $pdf->Cell(10,10,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->SetTextColor(128, 0, 0) ;
        $pdf->Cell(50,6,'Data produksi belum tersedia',0,0,'C');
      }

        $pdf->Output('Rekapitulasi-Produksi-'.$nm.'-'.$curYear.'.pdf', 'I');
?>