<?php
class print_master_budget extends controller{
	function index(){
			extract(PopulateForm());
			$session = $this->UserLogin->isLogin();
			$pt = $session['id_pt'];
			$rowdiv = $this->db->where('divisi_id',$divisi)
							  ->get('db_divisi')->row();
			if($budget == '1'){
				$budget = $rowdiv->divisi_nm." Original Budget";
				$data = $this->db->where('divisi_id',$divisi)
								 ->where('id_pt',$pt)	
								 ->where('thn',$thn)
								 ->order_by('code','ASC')
								 ->get('db_mstbgt')->result();
			}else{
				$budget = $rowdiv->divisi_nm." Current Budget";
				$data = $this->db->where('divisi_id',$divisi)
								 ->where('id_pt',$pt)
								 ->where('thn',$thn)
								 ->order_by('code','ASC')
								 ->get('db_mstbgt_update')->result();

			}
		
			require('fpdf/classreport.php');
			$pdf=new PDF('L','mm','A4');
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$judul = $budget;
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];
			$data_pt = $this->mstmodel->get_nama_pt($pt);
			$nama_pt = "PT \t".$data_pt['ket'];
			
			#Header
			$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
			$pdf->SetFont('Arial','B',14);
			$pdf->SetX(25);
			$pdf->Cell(0,10,$nama_pt,20,0,'L');
			//$pdf->SetLineWidth(0.5);
			//$pdf->Line(5,32,295,32);
			//$pdf->SetLineWidth(0);
			$pdf->SetFont('Arial','B',12);		
			$pdf->SetXY(25,16);
			$pdf->Cell(0,10,$judul,20,0,'L');
			$pdf->SetFont('Arial','B',10);
			$pdf->SetXY(25,22);
			$pdf->Cell(0,10,'Tahun : '.$thn,20,0,'L');
			#end header
			
			$y_axis_initial = 40;
			$y_axis = 0;
			$pdf->SetFont('Arial','',8);
			$pdf->setFillColor(222,222,222);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(4);
			$pdf->Cell(12,6,'Code',1,0,'C',1);
			$pdf->Cell(48,6,'Description',1,0,'C',1);
			//$pdf->Cell(20,6,'Project',1,0,'C',1);
			$pdf->Cell(16,6,'Januari',1,0,'C',1);
			$pdf->Cell(16,6,'Febuari',1,0,'C',1);
			$pdf->Cell(16,6,'Maret',1,0,'C',1);
			$pdf->Cell(16,6,'April',1,0,'C',1);
			$pdf->Cell(16,6,'Mei',1,0,'C',1);
			$pdf->Cell(16,6,'Juni',1,0,'C',1);
			$pdf->Cell(16,6,'Juli',1,0,'C',1);
			$pdf->Cell(16,6,'Agustus',1,0,'C',1);
			$pdf->Cell(16,6,'September',1,0,'C',1);
			$pdf->Cell(16,6,'Oktober',1,0,'C',1);
			$pdf->Cell(16,6,'November',1,0,'C',1);
			$pdf->Cell(16,6,'Desember',1,0,'C',1);
			$pdf->Cell(20,6,'Total Budget',1,0,'C',1);
			$pdf->Ln();
			$max=35;
			$row_height = 6;
			$y_axis = $y_axis + $row_height;
			#$i=0;
			$no=0;
			$totbgt1 = 0;
			$totbgt2 = 0;
			$totbgt3 = 0;
			$totbgt4 = 0;
			$totbgt5 = 0;
			$totbgt6 = 0;
			$totbgt7 = 0;
			$totbgt8 = 0;
			$totbgt9 = 0;
			$totbgt10 = 0;
			$totbgt11 = 0;
			$totbgt12 = 0;
			$tottot_mst = 0;
			foreach($data as $row){
				if ($no == $max){ 
					$pdf->AddPage();
					#Header
					$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
					$pdf->SetFont('Arial','B',12);
					$pdf->SetX(25);
					$pdf->Cell(0,10,'PT. Bakrie Swasakti Utama',20,0,'L');
					//$pdf->SetLineWidth(0.5);
					//$pdf->Line(5,32,295,32);
					//$pdf->SetLineWidth(0);		
					$pdf->SetXY(25,15);
					$pdf->Cell(0,10,$judul,20,0,'L');
					$pdf->SetXY(25,20);
					$pdf->Cell(0,10,'Tahun : '.$thn,20,0,'L');
					#end header

					$pdf->SetFont('Arial','',8);
					$pdf->SetY(40);
					$pdf->SetX(4);
					$pdf->Cell(12,6,'Code',1,0,'C',1);
					$pdf->Cell(48,6,'Description',1,0,'C',1);
					//$pdf->Cell(20,6,'Project',1,0,'C',1);
					$pdf->Cell(16,6,'Januari',1,0,'C',1);
					$pdf->Cell(16,6,'Febuari',1,0,'C',1);
					$pdf->Cell(16,6,'Maret',1,0,'C',1);
					$pdf->Cell(16,6,'April',1,0,'C',1);
					$pdf->Cell(16,6,'Mei',1,0,'C',1);
					$pdf->Cell(16,6,'Juni',1,0,'C',1);
					$pdf->Cell(16,6,'Juli',1,0,'C',1);
					$pdf->Cell(16,6,'Agustus',1,0,'C',1);
					$pdf->Cell(16,6,'September',1,0,'C',1);
					$pdf->Cell(16,6,'Oktober',1,0,'C',1);
					$pdf->Cell(16,6,'November',1,0,'C',1);
					$pdf->Cell(16,6,'Desember',1,0,'C',1);
					$pdf->Cell(20,6,'Total Budget',1,0,'C',1);
					$pdf->SetY(40);
					$pdf->SetX(25);
					$y_axis = $y_axis + $row_height;
					$no=0;
					$pdf->Ln();
				}
				$totbgt1 = $totbgt1 + ($row->bgt1);
				$totbgt2 = $totbgt2 + ($row->bgt2);
				$totbgt3 = $totbgt3 + ($row->bgt3);
				$totbgt4 = $totbgt4 + ($row->bgt4);
				$totbgt5 = $totbgt5 + ($row->bgt5);
				$totbgt6 = $totbgt6 + ($row->bgt6);
				$totbgt7 = $totbgt7 + ($row->bgt7);
				$totbgt8 = $totbgt8 + ($row->bgt8);
				$totbgt9 = $totbgt9 + ($row->bgt9);
				$totbgt10 = $totbgt10 + ($row->bgt10);
				$totbgt11 = $totbgt11 + ($row->bgt11);
				$totbgt12 = $totbgt12 + ($row->bgt12);
				$tottot_mst = $tottot_mst + ($row->tot_mst);
				$pdf->SetX(4);
				$pdf->SetFont('Arial','',5);
				$pdf->Cell(12,4,$row->code,1);
				$pdf->Cell(48,4,$row->descbgt,1);
				//$pdf->Cell(20,4,$row->proj,1);
				$pdf->Cell(16,4,number_format($row->bgt1,","),1,0,"R");
				$pdf->Cell(16,4,number_format($row->bgt2,","),1,0,"R");
				$pdf->Cell(16,4,number_format($row->bgt3,","),1,0,"R");
				$pdf->Cell(16,4,number_format($row->bgt4,","),1,0,"R");
				$pdf->Cell(16,4,number_format($row->bgt5,","),1,0,"R");
				$pdf->Cell(16,4,number_format($row->bgt6,","),1,0,"R");
				$pdf->Cell(16,4,number_format($row->bgt7,","),1,0,"R");
				$pdf->Cell(16,4,number_format($row->bgt8,","),1,0,"R");
				$pdf->Cell(16,4,number_format($row->bgt9,","),1,0,"R");
				$pdf->Cell(16,4,number_format($row->bgt10,","),1,0,"R");
				$pdf->Cell(16,4,number_format($row->bgt11,","),1,0,"R");
				$pdf->Cell(16,4,number_format($row->bgt12,","),1,0,"R");
				$pdf->Cell(20,4,number_format($row->tot_mst,","),1,0,"R");
				$pdf->Ln();
				$no++;
			}
			$pdf->SetX(4);
			$pdf->setFillColor(222,222,222);
			$pdf->Cell(60,4,"Total",1,0,'C',1);
			$pdf->Cell(16,4,number_format($totbgt1,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt2,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt3,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt4,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt5,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt6,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt7,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt8,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt9,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt10,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt11,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt12,","),1,0,'R',1);
			$pdf->Cell(20,4,number_format($tottot_mst,","),1,0,'R',1);
			$pdf->Output("hasil.pdf","I");	;
	}
}
