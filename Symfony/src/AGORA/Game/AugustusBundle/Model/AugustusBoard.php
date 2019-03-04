<?php

class AgustusBoard {
  
  // fillLine : Place les cartes sur le terrain, doublons avec le constructeur qui prépare déjà tout ?
  public function fillLine() {

  }
  
  // resetDeck : supprime toutes les cartes du deck, puis on ajoute des cartes (combien ? toutes les cartes de la base ?)
  public function resetDeck() {
    $this->deck->clear();
    // Comme pour le constructeur un while(fetch) ?
    while (1) {
      
    }
  }
  
  // resetBag : supprime les tokens du sac, puis on ajoute des tokens (comnien ? tous les tokens ?)
  public function resetBag() {
    $this->tokenBag->clear();
    // Comme pour le constructeur faire plusieurs while pour chaque type de token.
    for ($i = 0; $i < 23; $i++) {
      addTokenToBag(token::bouclier);
    }
  }
  
  // takeToken : Prend un token du sac à token de manière aléatoire.
  // return : Un token du sac.
  public function takeToken() {
    $nbAlea = rand(1, 23);
    $token = $this->tokenBag->get($nbAlea);
    removeTokenFromBag($this->token->get($nbAlea));
    return $token;
  }
  
}
