<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Calendar</title>
	<style>
		td {
			border: 1px solid grey;
			padding: 5px;
			text-align: center;
		}

		.normal:hover {
			color: white;
			background: black;
		}
		.weekend {
			color: red;
		}
		.weekend:hover {
			color: white;
			background: red;
		}
		.current {
			border: dashed blue 2px;
		}
	</style>
</head>
<body>
	<?php

		//текущий месяц , можем выбрать любой другой месяц этого года
			$month = date('m');
			echo "<h3>".date('M', mktime(0,0,0,$month, date('d'), date('Y')))."</h3>"

	?>
<table>
	<thead>
		<tr>
			<?php
				$weekDays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fre', 'Sat', 'Sun'];
				for($i=0; $i<7;$i++) {
					if($i==5||$i==6) {
						echo "<th style='color:red;'>$weekDays[$i]</th>";
					} else {
						echo "<th>$weekDays[$i]</th>";
					}
					
				}
			?>
		</tr>
	</thead>
	<tbody>
		<tr>
			
			<?php

			//$wd - переменная показывает порядковый номер дня недели
			//сравниваем с ней порядковый номер дня недели месяца для первой недели, если равны то заполняем, если нет - пустой квадратик
			 $wd=1; 
			 $nowDay = date('j');

				for($i=1; $i <=date('t', mktime(0,0,0,$month,date("d"),date('Y'))); $i++,$wd++) {

					//сбрасываем числа на новую неделю ( 1 - 7 )
					//и переводим на новую строку
					if($wd%8==0) {
						$wd = 1;
						echo "</tr><tr>";
					}

					//если номер дня недели $wd равен номеру дня недели объекта date() данного месяца, тогда заполняем, иначе пустой квадрат
					if( (date('N' , mktime(0,0,0, $month, $i, date('Y')))) != $wd  ) {
						$i=1;
						
						//Первый день месяца, записывается имнно отсюда, 1 число кажого месяца
						if((date('N' , mktime(0,0,0, $month, $i, date('Y')))) == $wd) {

							//если первый день месца сб или вс, окрашиваем в красный
							if((date('N' , mktime(0,0,0, $month, $i, date('Y')))) %6==0 || (date('N' , mktime(0,0,0, $month, $i, date('Y')))) %7==0) {
						 		echo "<td class='weekend'>".$i."</td>";
						 	} else {
						 		echo "<td class='normal'>".$i."</td>";
						 	}

						} else {
							echo "<td></td>";
						}
					}
					 else {

					 	//отмечаем текущий день
					 	if($i == $nowDay) {
					 		echo "<td class='current'>".$i."</td>";
					 		continue;
					 	}

					 	//если это выходные, окрашиваем красным цветом
					 	if((date('N' , mktime(0,0,0, $month, $i, date('Y')))) %6==0 || (date('N' , mktime(0,0,0, $month, $i, date('Y')))) %7==0) {
					 		echo "<td class='weekend'>".$i."</td>";
					 	} else {
					 		echo "<td class='normal'>".$i."</td>";
					 	}					
					}

					

					//это порядковый номер дня недели в данном месяце
					// echo "<td>".(date('N' , mktime(0,0,0, date('m'), $i, date('Y'))))." | $wd</td>";

				}

				//заканчиваем последнюю неделю пустыми квадратами, если нужно
				while($wd != 8) {
					echo "<td></td>";
					$wd++;
				}
				

			?>

		</tr>
	</tbody>
</table>
	
</body>
</html>

