<table class="books">
	<thead>
		<tr>
			<th>
				Book
			</th>
			<th>
				Compatibility
			</th>
			<th>
				Book Date
			</th>
			<th>
				Female AVG age
			</th>
			<th>
				Male AVG age
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<?php echo $el['Book']['name']; ?>
			</td>
			<td>
				<?php echo $el['Book']['percent'].'%'; ?>
			</td>
			<td>
				<?php echo $el['Book']['book_date']; ?>
			</td>
			<td>
				<?php 
					echo $el['Book']['Review']['after30']['female'];
				?>
			</td>
			<td>
				<?php 
					echo $el['Book']['Review']['after30']['male'];
				?>
			</td>
		</tr>
	</tbody>
</table>

<table class="books">
	<thead>
		<tr>
			<th>
				Book
			</th>
			<th>
				Compatibility
			</th>
			<th>
				Book Date
			</th>
			<th>
				Female AVG age
			</th>
			<th>
				Male AVG age
			</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($el['Books'] as $k=>$v){ 
		if(!($v['Review']['before30']['female'] == 0 && $v['Review']['before30']['male'] == 0)){ ?>
			<tr>
				<td>
					<?php echo $v['name']; ?>
				</td>
				<td>
					<?php echo $v['procent'].'%'; ?>
				</td>
				<td>
					<?php echo $v['date']; ?>
				</td>
				<td>
					<?php 
						echo $v['Review']['before30']['female'];
					?>
				</td>
				<td>
					<?php 
						echo $v['Review']['before30']['male'];
					?>
				</td>
			</tr>
	<?php 
		}
	} ?>
	</tbody>
</table>
