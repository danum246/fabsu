<?php

			ini_set('memory_limit','512M');
			require('fpdf/classreport.php');
			extract(PopulateForm());
			$pdf=new PDF('P','mm','A4');
			$tglx = date('M-Y',strtotime($tgl1));
			$tgly = date('M-Y',strtotime($tgl2));
			#die($tglx);
			$tglsatu = explode('-',$tgl1);
			$a = $tglsatu[1].$tglsatu[2];
			#die($a);
			
			$tgldua = explode('-',$tgl2);
			$b = $tgldua[1].$tgldua[2];
			
			
			
			#die($a.' '.$b.' '.$tgl1.' '.$tgl2.' '.$acc_no.' '.$acc_no2);
			#$tgl2 = date($tgl2);
			 //$this->load->helper('date');
			
			// $data = $this->db->query("sp_printgeneralledger '".inggris_date($tgl)."'")
							 // ->result();
							 
			$rows= $this->db->query("sp_printgeneralledgeracc2 '".$a."','".$b."','".$project_detail."','".inggris_date($tgl1)."','".inggris_date($tgl2)."','".$acc_no."','".$acc_no2."'")
									->result();
									
			#var_dump($rows);
			
			$pdf->SetMargins(3,5,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
				$pt			= "PT. BAKRIE SWASAKTI UTAMA";
				$judul 		= "General Ledger";
				$periode	= "Periode";
	
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#TANGGAL CETAK
				$pdf->SetFont('Arial','',6);
				/*
				$pdf->SetXY(258,10);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							
				$pdf->SetXY(268,10);
				$pdf->Cell(2,4,':',4,0,'L');
								
				$pdf->SetXY(269,10);
				$pdf->Cell(10,4,$tgl,0,0,'L');
				*/
				$pdf->Ln(1);
			
			#Header
				//$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',16);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','',8);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'As Of'.' : '.$tgl1. ' s/d '.$tgl2,20,0,'L');
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(1);
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(5);
		
		//$accname = $this->db->select('')
			
			// Start Isi Tabel
			$nmacc1 = $this->db->select('acc_name')->where('acc_no',$acc_no)->get('db_coa')->row();
			$nmacc2 = $this->db->select('acc_name')->where('acc_no',$acc_no2)->get('db_coa')->row();
			
			
			
			// Start Isi Tabel
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(15,5,'From Account',10,0,'L',0);
			$pdf->Cell(5,5,':',10,0,'C',0);
			$pdf->Cell(20,5,$acc_no,10,0,'L',0);
			$pdf->Cell(5,5,'',10,0,'C',0);
			$pdf->Cell(30,5,$nmacc1->acc_name,10,0,'L',0);
			$pdf->Ln(5);
			$pdf->Cell(15,5,'To Account',10,0,'L',0);
			$pdf->Cell(5,5,':',10,0,'C',0);
			$pdf->Cell(20,5,$acc_no2,10,0,'L',0);
			$pdf->Cell(5,5,'',10,0,'C',0);
			$pdf->Cell(30,5,$nmacc2->acc_name,10,0,'L',0);
			$pdf->Ln(5);
		
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(4);
			/*
			$pdf->Cell(15,10,'Trans. Date',10,0,'C',0);
			$pdf->Cell(20,10,'Account No.',10,0,'C',0);
			$pdf->Cell(30,10,'Acc. Name',10,0,'C',0);
			$pdf->Cell(50,10,'Description',10,0,'C',0);
			$pdf->Cell(88,5,'In Base Currency',10,0,'C',0);
			$pdf->Ln(5);
			
			$pdf->Cell(15,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(30,5,'',10,0,'C',0);
			$pdf->Cell(50,5,'',10,0,'C',0);
			$pdf->Cell(30,5,'Debit',10,0,'R',0);
			$pdf->Cell(30,5,'Credit',10,0,'R',0);
			$pdf->Cell(28,5,'Saldo',10,0,'R',0);
			*/
			$pdf->Cell(20,7,'Trans. Date','T','B',0,'L',0);
			//$pdf->Cell(30,7,'','T','B',0,'L',0);
			//$pdf->Cell(30,7,'','T','B',0,'L',0);
			$pdf->Cell(48,7,'Description','T','B',0,'L',0);
			$pdf->Cell(41,7,'','T','B',0,'L',0);

			$pdf->Cell(30,7,'Debit','T','B',0,'R',0);
			$pdf->Cell(30,7,'Credit','T','B',0,'R',0);
			$pdf->Cell(30,7,'Saldo','T','B',0,'R',0);
			$pdf->Cell(28,7,'','T','B',0,'R',0);
		
			$pdf->SetFont('Arial','',6);
			
			$i = 1;	
			$h = 1;
			$no = 1;
			$noo = 0;
			$max = 15;
			$xmax = 40;	
			$pdf->Ln(8);
			
		
foreach($rows as $row){	
		#tambah header
	//~ if($no == $max){ 
			//~ $pdf->AddPage();
			//~ $pdf->SetFont('Arial','B',12);
			//~ $pdf->setFillColor(222,222,222);
			//~ 
			//~ #HEAD
			//~ #HEADER CONTENT
				//~ $pt			= "PT. GRAHA MULTI INSANI";
				//~ $judul 		= "General Ledger";
				//~ $periode	= "Periode";
	//~ 
			//~ #CETAK TANGGAL
				//~ $tgl  = date("d-m-Y");
			//~ #TANGGAL CETAK
				//~ $pdf->SetFont('Arial','',6);
				//~ /*
				//~ $pdf->SetXY(258,10);
				//~ $pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							//~ 
				//~ $pdf->SetXY(268,10);
				//~ $pdf->Cell(2,4,':',4,0,'L');
								//~ 
				//~ $pdf->SetXY(269,10);
				//~ $pdf->Cell(10,4,$tgl,0,0,'L');
				//~ */
				//~ $pdf->Ln(1);
			//~ 
			//~ #Header
				//~ $pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				//~ $pdf->SetFont('Arial','B',16);
	//~ 
				//~ $pdf->SetX(25);
				//~ $pdf->Cell(0,10,$pt,20,0,'L');
			//~ 
				//~ $pdf->SetFont('Arial','B',12);
				//~ 
				//~ $pdf->SetXY(25,16);
				//~ $pdf->Cell(0,10,$judul,20,0,'L');
				//~ $pdf->SetFont('Arial','',8);
				//~ $pdf->SetXY(25,22);
				//~ $pdf->Cell(0,10,'As Of'.' : '.$tglx. ' s/d '.$tgly,20,0,'L');
				//~ $pdf->Ln(10);
				//~ 
				//~ $pdf->Cell(0,0,'',1,0,'L');
				//~ $pdf->Ln(1);
				//~ $pdf->Cell(0,0,'',1,0,'L');
				//~ $pdf->Ln(5);
		//~ 
		//~ //$accname = $this->db->select('')
			//~ 
			//~ // Start Isi Tabel
			//~ $nmacc1 = $this->db->select('acc_name')->where('acc_no',$acc_no)->get('db_coa')->row();
			//~ $nmacc2 = $this->db->select('acc_name')->where('acc_no',$acc_no2)->get('db_coa')->row();
			//~ 
			//~ 
			//~ // Start Isi Tabel
			//~ $pdf->SetFont('Arial','',8);
			//~ $pdf->Cell(15,5,'From Account',10,0,'L',0);
			//~ $pdf->Cell(5,5,':',10,0,'C',0);
			//~ $pdf->Cell(20,5,$acc_no,10,0,'L',0);
			//~ $pdf->Cell(5,5,'',10,0,'C',0);
			//~ $pdf->Cell(30,5,$nmacc1->acc_name,10,0,'L',0);
			//~ $pdf->Ln(5);
			//~ $pdf->Cell(15,5,'To Account',10,0,'L',0);
			//~ $pdf->Cell(5,5,':',10,0,'C',0);
			//~ $pdf->Cell(20,5,$acc_no2,10,0,'L',0);
			//~ $pdf->Cell(5,5,'',10,0,'C',0);
			//~ $pdf->Cell(30,5,$nmacc2->acc_name,10,0,'L',0);
			//~ $pdf->Ln(5);
		//~ 
			//~ $pdf->SetFont('Arial','B',8);
			//~ $pdf->Ln(4);
			//~ /*
			//~ $pdf->Cell(15,10,'Trans. Date',10,0,'C',0);
			//~ $pdf->Cell(20,10,'Account No.',10,0,'C',0);
			//~ $pdf->Cell(30,10,'Acc. Name',10,0,'C',0);
			//~ $pdf->Cell(50,10,'Description',10,0,'C',0);
			//~ $pdf->Cell(88,5,'In Base Currency',10,0,'C',0);
			//~ $pdf->Ln(5);
			//~ 
			//~ $pdf->Cell(15,5,'',10,0,'C',0);
			//~ $pdf->Cell(20,5,'',10,0,'C',0);
			//~ $pdf->Cell(30,5,'',10,0,'C',0);
			//~ $pdf->Cell(50,5,'',10,0,'C',0);
			//~ $pdf->Cell(30,5,'Debit',10,0,'R',0);
			//~ $pdf->Cell(30,5,'Credit',10,0,'R',0);
			//~ $pdf->Cell(28,5,'Saldo',10,0,'R',0);
//~ */
			//~ $pdf->Cell(15,5,'Trans. Date',10,0,'C',0);
			//~ $pdf->Cell(20,5,'Account No.',10,0,'C',0);
			//~ $pdf->Cell(30,5,'Acc. Name',10,0,'C',0);
			//~ $pdf->Cell(50,5,'Description',10,0,'C',0);
			//~ $pdf->Cell(30,5,'Debit',10,0,'R',0);
			//~ $pdf->Cell(30,5,'Credit',10,0,'R',0);
			//~ $pdf->Cell(28,5,'Saldo',10,0,'R',0);
//~ 
			//~ $no = 0;
			//~ 
			//~ 
	//~ 
			//~ 
		//~ }
		
			//die($row->acc_no);
			
			$period = date('Ym',strtotime($tgl1));
		
			 // $begining2 = "select isnull(((balance_base+db_base)-cr_base),0) as a from db_trlbal 
								// where acc_period=(select distinct acc_period - 1 from db_trlbal where acc_period=".$period.") and acc_no='".$row->acc_no."'";
			 $begining2 = "select isnull(balance_base,0) as a from db_trlbal 
								where acc_period=".$period." and acc_no='".$row->acc_no."'";
					
					  $begining = $this->db->query($begining2)->row();     


			$pdf->SetFont('Arial','B',7);		
		//	$pdf->Cell(20,6,'','T,B','B',0,'L',0);
			$pdf->Cell(20,6,@$row->acc_no,'T,B',0,'L',0);
			$pdf->Cell(35,6,@$row->acc_name,'T,B',0,'L',0);
            $pdf->Cell(50,6,'','T,B',0,'C',0);
            $pdf->Cell(20,6,'Begining Balance','T,B',0,'R',0);
			$pdf->Cell(20,6,'','T,B',0,'R',0);
			$pdf->Cell(28,6,number_format(@$begining->a),'T,B',0,'R',0);
			$pdf->Ln(6);
			
			$tglx = date('M-Y',strtotime($tgl1));
			$tgly = date('M-Y',strtotime($tgl2));
			#die($tglx);
			$tglsatu = explode('-',$tgl1);
			$a = $tglsatu[1].$tglsatu[2];
			#die($a);
			
			$tgldua = explode('-',$tgl2);
			$b = $tgldua[1].$tgldua[2];
			
			
			$data2 = $this->db->query("sp_printgeneralledgeracc '".$a."','".$b."','".inggris_date($tgl1)."','".inggris_date($tgl2)."','".$row->acc_no."'")
			//$data2 = $this->db->query("sp_printgeneralledgeracc '".$a."','".$b."','".$row->acc_no."'")
							 ->result();
			
			$pdf->Ln(3);		
					
			$a = 0;
			$b = 0;
			$saldo= 0;
			$saldot = 0;
			$saldox = 0;
			$pdf->SetFont('Arial','',6);
							
	foreach($data2 as $roow){
			$a = $a + $roow->debit;
			$b = $b + $roow->credit;
					


	//~ if($noo == $xmax){ 
		//~ 
			//~ $pdf->AddPage();
			//~ $pdf->SetFont('Arial','B',12);
			//~ $pdf->setFillColor(222,222,222);
			//~ 
			//~ #HEAD
			//~ #HEADER CONTENT
				//~ $pt			= "PT. GRAHA MULTI INSANI";
				//~ $judul 		= "General Ledger";
				//~ $periode	= "Periode";
	//~ 
			//~ #CETAK TANGGAL
				//~ $tgl  = date("d-m-Y");
			//~ #TANGGAL CETAK
				//~ $pdf->SetFont('Arial','',6);
				//~ /*
				//~ $pdf->SetXY(258,10);
				//~ $pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							//~ 
				//~ $pdf->SetXY(268,10);
				//~ $pdf->Cell(2,4,':',4,0,'L');
								//~ 
				//~ $pdf->SetXY(269,10);
				//~ $pdf->Cell(10,4,$tgl,0,0,'L');
				//~ */
				//~ $pdf->Ln(1);
			//~ 
			//~ #Header
				//~ $pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				//~ $pdf->SetFont('Arial','B',16);
	//~ 
				//~ $pdf->SetX(25);
				//~ $pdf->Cell(0,10,$pt,20,0,'L');
			//~ 
				//~ $pdf->SetFont('Arial','B',12);
				//~ 
				//~ $pdf->SetXY(25,16);
				//~ $pdf->Cell(0,10,$judul,20,0,'L');
				//~ $pdf->SetFont('Arial','',8);
				//~ $pdf->SetXY(25,22);
				//~ $pdf->Cell(0,10,'As Of'.' : '.$tglx. ' s/d '.$tgly,20,0,'L');
				//~ $pdf->Ln(10);
				//~ 
				//~ $pdf->Cell(0,0,'',1,0,'L');
				//~ $pdf->Ln(1);
				//~ $pdf->Cell(0,0,'',1,0,'L');
				//~ $pdf->Ln(5);
		//~ 
		//~ //$accname = $this->db->select('')
			//~ 
			//~ // Start Isi Tabel
			//~ $nmacc1 = $this->db->select('acc_name')->where('acc_no',$acc_no)->get('db_coa')->row();
			//~ $nmacc2 = $this->db->select('acc_name')->where('acc_no',$acc_no2)->get('db_coa')->row();
			//~ 
			//~ 
			//~ // Start Isi Tabel
			//~ $pdf->SetFont('Arial','',9);
			//~ $pdf->Cell(15,5,'From Account',10,0,'L',0);
			//~ $pdf->Cell(5,5,':',10,0,'C',0);
			//~ $pdf->Cell(20,5,$acc_no,10,0,'L',0);
			//~ $pdf->Cell(5,5,'',10,0,'C',0);
			//~ $pdf->Cell(30,5,$nmacc1->acc_name,10,0,'L',0);
			//~ $pdf->Ln(5);
			//~ $pdf->Cell(15,5,'To Account',10,0,'L',0);
			//~ $pdf->Cell(5,5,':',10,0,'C',0);
			//~ $pdf->Cell(20,5,$acc_no2,10,0,'L',0);
			//~ $pdf->Cell(5,5,'',10,0,'C',0);
			//~ $pdf->Cell(30,5,$nmacc2->acc_name,10,0,'L',0);
			//~ $pdf->Ln(5);
		//~ 
			//~ $pdf->SetFont('Arial','B',8);
			//~ $pdf->Ln(4);
			//~ /*
			//~ $pdf->Cell(15,10,'Trans. Date',10,0,'C',0);
			//~ $pdf->Cell(20,10,'Account No.',10,0,'C',0);
			//~ $pdf->Cell(30,10,'Acc. Name',10,0,'C',0);
			//~ $pdf->Cell(50,10,'Description',10,0,'C',0);
			//~ $pdf->Cell(88,5,'In Base Currency',10,0,'C',0);
			//~ $pdf->Ln(5);
			//~ 
			//~ $pdf->Cell(15,5,'Trans. Date',10,0,'C',0);
			//~ $pdf->Cell(20,5,'Account No.',10,0,'C',0);
			//~ $pdf->Cell(30,5,'Acc. Name',10,0,'C',0);
			//~ $pdf->Cell(50,5,'Description',10,0,'C',0);
			//~ $pdf->Cell(30,5,'Debit',10,0,'R',0);
			//~ $pdf->Cell(30,5,'Credit',10,0,'R',0);
			//~ $pdf->Cell(28,5,'Saldo',10,0,'R',0);
			//~ */
			//~ $pdf->Cell(15,5,'Trans. Date',10,0,'L',0);
			//~ $pdf->Cell(20,5,'Account No.',10,0,'C',0);
			//~ $pdf->Cell(30,5,'Acc. Name',10,0,'C',0);
			//~ $pdf->Cell(50,5,'Description',10,0,'C',0);
			//~ $pdf->Cell(30,5,'Debit',10,0,'R',0);
			//~ $pdf->Cell(30,5,'Credit',10,0,'R',0);
			//~ $pdf->Cell(28,5,'Saldo',10,0,'R',0);
			//~ 
			//~ $pdf->Ln(3);
//~ 
			//~ $pdf->SetFont('Arial','B',7);		
			//~ $pdf->Cell(15,10,'',10,0,'L',0);
			//~ $pdf->Cell(20,10,@$row->acc_no,10,0,'L',0);
			//~ $pdf->Cell(30,10,@$row->acc_name,10,0,'L',0);
            //~ $pdf->Cell(50,10,'Begining Balance',10,0,'C',0);
            //~ $pdf->Cell(30,5,'',10,0,'C',0);
			//~ $pdf->Cell(30,5,'',10,0,'C',0);
			//~ $pdf->Cell(28,10,number_format(@$begining->a),10,0,'R',0);
			//~ $pdf->Ln(6);
	//~ 
			//~ #$pdf->SetFont('Arial','',8);
			//~ 
			//~ $noo = 0;
			//~ #$i = 0;
			//~ 
		//~ }


$pdf->SetFont('Arial','',6.5);
		
			if ($i == 1){			
			$saldot=$saldo + (((@$begining->a)+(@$roow->debit))-(@$roow->credit));
		}else{
			$saldot=$saldot + ((@$roow->debit)-(@$roow->credit));
			
			
	}
	
			$saldox = $saldox + $saldot;
			#$pdf->Cell(15,5,$i,10,0,'C',0);
			$pdf->Cell(20,5,indo_date(@$roow->trans_date),10,0,'C',0);
			$pdf->Cell(30,5,@$roow->voucher,10,0,'L',0);
			#$pdf->Cell(30,5,substr(@$roow->acc_name,0,20),10,0,'L',0);
			
			#if(@$roow->line_desc == 
			$pdf->Cell(80,5,substr(@$roow->line_desc,0,60),10,0,'L',0);
			$pdf->Cell(30,5,number_format(@$roow->debit),10,0,'L',0);
			$pdf->Cell(30,5,number_format(@$roow->credit),10,0,'L',0);
			$pdf->Cell(28,5,number_format(@$saldot),10,0,'L',0);
			$pdf->Ln(5);
			$pdf->SetX(53);
			$pdf->Cell(80,5,substr(@$roow->line_desc,60,80),10,0,'L',0);
			#$pdf->SetXY(118,50);
			
			
			$pdf->Ln(5);	
			$noo++;
			$i++;
			
					
	
					
					}
			$i = 1;				
				#buat garis		
			$pdf->Ln(3);
			$pdf->Cell(15,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'L',0);
			$pdf->Cell(30,5,'',10,0,'R',0);
			$pdf->Cell(50,5,'',10,0,'R',0);
			$pdf->Cell(30,0,'',1,0,'C',0);
			$pdf->Cell(30,0,'',1,0,'C',0);
			$pdf->Cell(28,0,'',1,0,'C',0);
			
			$pdf->Ln(1);
			
			if($saldot==0){
			
			}
			else{
			
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(15,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'L',0);
			#$pdf->Cell(30,5,'',10,0,'R',0);
			$pdf->Cell(80,5,'Sub Total :',10,0,'R',0);
			$pdf->Cell(30,5,number_format($a),10,0,'R',0);
			$pdf->Cell(30,5,number_format($b),10,0,'R',0);
			$pdf->Cell(28,5,number_format($saldot),10,0,'R',0);
           }
					$pdf->Ln(3);		
			
			#End garis		
			$pdf->Ln(3);
			$pdf->Cell(15,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'L',0);
			$pdf->Cell(30,5,'',10,0,'R',0);
			$pdf->Cell(50,5,'',10,0,'R',0);
			$pdf->Cell(30,0,'',1,0,'C',0);
			$pdf->Cell(30,0,'',1,0,'C',0);
			$pdf->Cell(28,0,'',1,0,'C',0);
			
			$pdf->Ln(1);
	
	$pdf->Ln(3);
	$h++;
	$no++;
	}

		$pdf->SetFont('Arial','B',8);
		$pdf->Ln(15);
		$pdf->SetFont('Arial','',8);
		$pdf->SetX(180);
		//~ $pdf->Cell(10,4,'Print Date',0,0,'L',0);	
		//~ $pdf->Cell(2,4,':',4,0,'L');
		//~ $pdf->Cell(2,4,date("Y-m-d"),4,0,'L');
		$pdf->Output("hasil.pdf","I");	;
	
