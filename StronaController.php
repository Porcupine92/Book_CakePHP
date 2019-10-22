<?php
App::uses('AppController', 'Controller');

class StronaController extends AppController {
	
	public $uses = array('Book');
	
	public function beforeFilter() {
		parent::beforeFilter();
		
	}
	
	public function index(){
		$el = array();
		$book = 'ZieLoNa MiLa';
		$books = 'ZiElonA Droga';
		
		$tmp['Book'] = $this->Book->find('first', array(
			'conditions' => array(
				'Book.name' => $book,
			)
		));
		
	//Przepisuje dane książki do tablicy el która pójdzie do view
		similar_text(strtolower($book), strtolower($tmp['Book']['Book']['name']), $percent);
		$tmp['Book']['Book']['percent'] = round($percent,2);
		$el['Book'] = $tmp['Book']['Book'];
	//przygotowywuje dane statystyczne - pusta tablica
		$tmp['Review'] = array(
			'before30'	=>array(
				'female'=>array(
					'no'    =>0,
					'all'   =>0
				),
				'male'	=>array(
					'no'    =>0,
					'all'   =>0
				)
			),
			'after30'	=>array(
				'female'=>array(
					'no'    =>0,
					'all'   =>0
				),
				'male'	=>array(
					'no'    =>0,
					'all'   =>0
				)
			)
		);
		
	//analizuje otrzymane wyniki    
		foreach($tmp['Book']['Review'] as $k=>$v){
			if($v['sex'] == 'f'){
				if($v['age'] < 30){
					$tmp['Review']['before30']['female']['no'] += 1;
					$tmp['Review']['before30']['female']['all'] += $v['age']; 
				}elseif($v['age']>30){
					$tmp['Review']['after30']['female']['no'] += 1;
					$tmp['Review']['after30']['female']['all'] += $v['age']; 
				}
			}else{
				if($v['age'] < 30){
					$tmp['Review']['before30']['male']['no'] += 1;
					$tmp['Review']['before30']['male']['all'] += $v['age']; 
				}elseif($v['age'] > 30){
					$tmp['Review']['after30']['male']['no'] += 1;
					$tmp['Review']['after30']['male']['all'] += $v['age']; 
				}
			}
		}
		  
	//przygotowuje domyślne dane
		$el['Book']['Review'] = array(
			'before30'=>array(
				'female' =>  0,
				'male'   =>  0
			),
			'after30'=>array(
				'female' =>  0,
				'male'   =>  0
			)
		); 
		
	//wyciągam średnie z analizy wyników 
		if($tmp['Review']['before30']['female']['no']){
			$el['Book']['Review']['before30']['female'] = round(($tmp['Review']['before30']['female']['all'] / $tmp['Review']['before30']['female']['no']), 2);
		}
		if($tmp['Review']['before30']['male']['no']){
			$el['Book']['Review']['before30']['male'] = round(($tmp['Review']['before30']['male']['all'] / $tmp['Review']['before30']['male']['no']), 2);
		}
		if($tmp['Review']['after30']['female']['no']){
			$el['Book']['Review']['after30']['female'] = round(($tmp['Review']['after30']['female']['all'] / $tmp['Review']['after30']['female']['no']), 2);
		}
		if($tmp['Review']['after30']['male']['no']){
			$el['Book']['Review']['after30']['male'] = round(($tmp['Review']['after30']['male']['all'] / $tmp['Review']['after30']['male']['no']), 2);
		}
				
	//Wyszukuje wszystkie książki
		$tmp['Book'] = $this->Book->find('all');
	
	//Przygotowuje tabelę na książki
		$el['Books'] = array();

		foreach($tmp['Book'] as $kb=>$vb){
			//Przypisuje dane książek do tablicy el która pójdzie do view
				similar_text(strtolower($books), strtolower($vb['Book']['name']), $percent);
				$pom = array(
					'name'      =>$vb['Book']['name'],
					'date' 		=>$vb['Book']['book_date'],
					'procent'   =>round($percent, 2),
					'Review'    =>array(
						'before30'=>array(
							'female' =>  0,
							'male'   =>  0
						),
						'after30'=>array(
							'female' =>  0,
							'male'   =>  0
						)
					)
				);
				
			//Przygotowywuje dane statystyczne - pusta tablica
				$tmp['Review'] = array(
					'before30'	=>array(
						'female'=>array(
							'no'    =>0,
							'all'   =>0
						),
						'male'	=>array(
							'no'    =>0,
							'all'   =>0
						)
					),
					'after30'	=>array(
						'female'=>array(
							'no'    =>0,
							'all'   =>0
						),
						'male'	=>array(
							'no'    =>0,
							'all'   =>0
						)
					)
				);

			//Analizuje otrzymane wyniki    
				foreach($vb['Review'] as $k=>$v){
					if($v['sex'] == 'f'){
						if($v['age'] < 30){
							$tmp['Review']['before30']['female']['no'] += 1;
							$tmp['Review']['before30']['female']['all'] += $v['age']; 
						}elseif($v['age'] > 30){
							$tmp['Review']['after30']['female']['no'] += 1;
							$tmp['Review']['after30']['female']['all'] += $v['age']; 
						}
					}else{
						if($v['age'] < 30){
							$tmp['Review']['before30']['male']['no'] += 1;
							$tmp['Review']['before30']['male']['all'] += $v['age']; 
						}elseif($v['age'] > 30){
							$tmp['Review']['after30']['male']['no'] += 1;
							$tmp['Review']['after30']['male']['all'] += $v['age']; 
						}
					}
				}
				
			//Wyciągam średnie z analizy wyników 
				if($tmp['Review']['before30']['female']['no']){
					$pom['Review']['before30']['female'] = round(($tmp['Review']['before30']['female']['all'] / $tmp['Review']['before30']['female']['no']), 2);
				}
				if($tmp['Review']['before30']['male']['no']){
					$pom['Review']['before30']['male'] = round(($tmp['Review']['before30']['male']['all'] / $tmp['Review']['before30']['male']['no']), 2);
				}
				if($tmp['Review']['after30']['female']['no']){
					$pom['Review']['after30']['female'] = round(($tmp['Review']['after30']['female']['all'] / $tmp['Review']['after30']['female']['no']), 2);
				}
				if($tmp['Review']['after30']['male']['no']){
					$pom['Review']['after30']['male'] = round(($tmp['Review']['after30']['male']['all'] / $tmp['Review']['after30']['male']['no']), 2);
				}
			
			$el['Books'][] = $pom;
		}
		
		$this->set('el', $el);
    }
	
}
?>
