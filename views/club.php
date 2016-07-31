<style>.color{background-color: <?=$this->data['clubinfo']['clubcolor']?>;}</style>
<main>
	<div class='content'>
		<section>
			<div class='grid-100'>
				<div class='club-box'>
					<div class='club-color color'>
					</div>
					<div class='club-logo'>
						<img src='<?=$this->data['tree']?>assets/img/logos/<?=$this->data['clubinfo']['logo']?>' width="200px" height="200px">
					</div>
					<div class='club-name'>
						<?=$this->data['clubname']?>
						<span class='nickname'>[<?=$this->data['clubinfo']['nickname']?>]</span>
					</div>
					<div class='manager'>
						<?=$this->data['clubinfo']['manager'];?>
					</div>
					<div class='club-stats'>
						<ul>
							<li><a href='<?=$this->data['tree']?><?=$this->data['leagueURL'];?>'><?=$this->data['clubinfo']['league']?></a></li>
							<li>Média de rec.</li>
							<li><?=$this->data['clubinfo']['buddies']?></li>
						</ul>
					</div>
					<div class='club-history'>
						<h4>História do clube</h4>
						<p>
							<?=	$this->data['clubinfo']['history'];?>
						</p>
					</div>
					<div class='options right'>
						<?
						if($this->request['id']!=$_SESSION['SL_club']){
						?>
						<button class='btn btn-border letter-small'>Adicionar aos amigos</button>
						<button class='btn btn-border letter-small'>Mensagem</button>
						<button class='btn btn-border letter-small'>Banir</button>
						<?}else{?>
							<button class='btn btn-border letter-small'>Alterar informações do clube</button>
						<?}?>
					</div>
				</div>
				<div class='box'>
					<div class='box-title color'>
						Galeria de troféus
					</div>
					<div class='box-content trophies'>
						Nenhum troféu a mostrar
					</div>
				</div>
				<div class='box'>
					<div class='box-title color'>
						Feed
					</div>
					<div class='box-content trophies'>
						Nenhum feed
					</div>
				</div>
			</div>
		</section>
	</div>
</main>
