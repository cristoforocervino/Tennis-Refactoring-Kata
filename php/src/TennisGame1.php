<?php

namespace TennisGame;

class TennisGame1 implements TennisGame
{
    private $player1Score = 0;
    private $player2Score = 0;
    private $player1Name = '';
    private $player2Name = '';

    public function __construct($player1Name, $player2Name)
    {
        $this->player1Name = $player1Name;
        $this->player2Name = $player2Name;
    }

    public function wonPoint($playerName)
    {
        if ($this->player1Name === $playerName) {
            $this->player1Score++;
        } else {
            $this->player2Score++;
        }
    }

    public function getScore()
    {
        $score = "";
        if ($this->player1Score == $this->player2Score) {
            switch ($this->player1Score) {
                case 0:
                    $score = "Love-All";
                    break;
                case 1:
                    $score = "Fifteen-All";
                    break;
                case 2:
                    $score = "Thirty-All";
                    break;
                default:
                    $score = "Deuce";
                    break;
            }
        } elseif ($this->player1Score >= 4 || $this->player2Score >= 4) {
            $minusResult = $this->player1Score - $this->player2Score;
            if ($minusResult == 1) {
                $score = "Advantage player1";
            } elseif ($minusResult == -1) {
                $score = "Advantage player2";
            } elseif ($minusResult >= 2) {
                $score = "Win for player1";
            } else {
                $score = "Win for player2";
            }
        } else {
            for ($i = 1; $i < 3; $i++) {
                if ($i == 1) {
                    $tempScore = $this->player1Score;
                } else {
                    $score .= "-";
                    $tempScore = $this->player2Score;
                }
                switch ($tempScore) {
                    case 0:
                        $score .= "Love";
                        break;
                    case 1:
                        $score .= "Fifteen";
                        break;
                    case 2:
                        $score .= "Thirty";
                        break;
                    case 3:
                        $score .= "Forty";
                        break;
                }
            }
        }
        return $score;
    }
}
