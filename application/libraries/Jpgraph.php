<?php
class Jpgraph {
    function linechart($xdata, $ydata, $title='Line Chart')
    {
        require_once ('jpgraph/jpgraph.php');
		require_once ('jpgraph/jpgraph_line.php');
		
		// Setup the graph
		$graph = new Graph(770,250,"auto",60);
		//$graph->SetMargin(70,70,70,70);
		// Manually set Y-scale min=30, max=90 
		//$graph->SetScale('textlin',30,90); 
		$graph->SetScale("textlin");
		//$graph->SetScale('intlin');

		// Let JpGraph figure out suitable tick marks 
		$graph->yscale->SetAutoTicks(); 

		
		$theme_class=new UniversalTheme;
		
		$graph->SetTheme($theme_class);
		$graph->img->SetAntiAliasing();
		$graph->title->Set($title);
		$graph->SetBox(false);
		
		//eixo y
		$graph->yaxis->title->Set('Quantidade');
		$graph->yaxis->HideZeroLabel();
		$graph->yaxis->HideLine(false);
		$graph->yaxis->HideTicks(false,false);
		$graph->yaxis->scale->SetAutoMin(0); // valor inicial igual a zero
		$graph->yaxis->SetTitlemargin(30);
	
		//$graph->yaxis->SetLabelMargin(5); 
		
		//eixo x
		$graph->xaxis->title->Set('Dia/Mês');
		$graph->xgrid->Show();
		$graph->xgrid->SetLineStyle("solid");;
		$graph->xgrid->SetColor('#E3E3E3');
		$graph->xaxis->SetTickLabels($xdata);
		
		// Create the first line
		$plot = new LinePlot($ydata);
		$graph->Add($plot);

		$plot->SetColor("red");
		$plot->SetLegend('Ocorrências');
		$plot->value->Show();
		
		$graph->legend->SetFrameWeight(1);
		
        return $graph; // does PHP5 return a reference automatically?
    }
    
    

    function barValueFormat($aLabel) {
	    // Format '1000 english style
	    return number_format($aLabel);
	    // Format '1000 french style
	    // return number_format($aLabel, 2, ',', ' ');
	}



	function barchart($xdata, $ydata, $title='Bar Chart')
    {
        require_once("jpgraph/jpgraph.php");
        require_once("jpgraph/jpgraph_bar.php");    


        function barValueFormat($ydata) {
		    // Format '1000 english style
		    return number_format($ydata);
		    // Format '1000 french style
		    // return number_format($aLabel, 2, ',', ' ');
		}


        
        // Create the graph. These two calls are always required
        $graph = new Graph(770,250,"auto",60);

        $graph->SetMargin(70,50,59,65);
        //$graph->SetScale("textlin");
        $graph->SetScale("textint");
        //$graph->SetShadow();

        $graph->SetFrame(true,'gray',1);

		//$graph->SetFrame(false); // No border around the graph

        
        //$theme_class=new UniversalTheme;
		
		//$graph->SetTheme($theme_class);
		//$graph->img->SetAntiAliasing();
        // Setup title
       	$graph->title->SetMargin(10);
        $graph->title->Set($title);

        //eixo x
		$graph->xaxis->title->Set('Dia/Mês');
		//$graph->xaxis->SetTitle('Values for 2002','middle'); 
		$graph->xaxis->SetTitleMargin(35); 
		//$graph->xaxis->SetLabelMargin(50); 
		//$graph->xaxis->SetTitleSide(SIDE_TOP); 
		//$graph->xaxis->title->SetPos(0.5,0.98,'center','bottom');



		//$graph->xgrid->Show();
		$graph->xgrid->SetLineStyle("solid");;
		$graph->xgrid->SetColor('#E3E3E3');
		$graph->xaxis->SetLabelAngle(90);
		//$graph->xaxis->SetLabelMargin(15); 

		//$graph->xaxis->SetTitleSide(SIDE_BOTTOM); 

		$graph->xaxis->SetTickLabels($xdata);

		//eixo y
		$graph->yaxis->title->Set('Quantidade');
		$graph->yaxis->SetTitleMargin(35); 
		$graph->yaxis->scale->SetAutoMin(0);
        
        // Create the linear plot
        $plot=new BarPlot($ydata);
        $graph->Add($plot);
        $plot->SetColor("gray");
        $plot->SetWidth(10);
        //$plot->value->SetFormt('%s'); 
        $plot->value->SetFormatCallback('barValueFormat');
        //$plot->SetValuePos('center');
       	//$plot->value->SetMargin(100);
       	//$plot->value->SetAlign('left');
        $plot->value->SetColor("black","darkred"); 
        //$plot->value->SetAngle(45);
        $plot->value->Show();

        $plot->SetFillColor('red');
        //$plot->SetShadow("gray");
        
        // Add the plot to the graph
        
        
        return $graph; // does PHP5 return a reference automatically?
    }
    
	function piechart($xdata, $ydata, $title='Line Chart')
    {
        require_once ('jpgraph/jpgraph.php');
		require_once ('jpgraph/jpgraph_pie.php');
		//require_once ('jpgraph/jpgraph_pie3d.php');   

		// Create the Pie Graph. 
		$graph = new PieGraph(500, 400);
		$graph->SetAntiAliasing();
		$graph->SetShadow();

		
		$theme_class= new SoftyTheme;
		$graph->SetTheme($theme_class);
		
		// Set A title for the plot
		$graph->title->Set($title);
		$graph->title->SetFont(FF_FONT2,FS_BOLD);
		
		
		// Create
		//$p1 = new PiePlot3D($ydata);
		$p1 = new PiePlot($ydata);
		
		$p1->SetSize(0.23);
		$p1->SetCenter(0.5,0.40);
		
		// Enable and set policy for guide-lines. Make labels line up vertically
		$p1->SetGuideLines(true,false);
		$p1->SetGuideLinesAdjust(1.5);
		
		$p1->ShowBorder();
		$p1->SetColor('black');
		$p1->ExplodeAll(5);

		$p1->value->SetFormat("%d");

		//$p1->value->SetFormatCallback('valueFormat');
		
		$p1->value->Show(); // Defaults to TRUE
		$p1->SetLabelPos(1.0);
		$p1->SetValueType(PIE_VALUE_ABS);
		$p1->SetLegends($xdata);

		$graph->legend->SetPos(0.5,0.93,'center','bottom');
		$graph->legend->SetColumns(2);

        // Add the plot to the graph
        $graph->Add($p1);
        
        return $graph; // does PHP5 return a reference automatically?
    }
    
    function valueFormat($aLabel) {
    	// Format '1000 english style
    	return number_format($aLabel);
    	// Format '1000 french style
    	// return number_format($aLabel, 2, ',', ' ');
    }
    
    
    
    
} 
?>
