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

    private function isEven(): bool
    {
        return $this->player1Score === $this->player2Score;
    }

    private function isPlayoff(): bool
    {
        return ($this->player1Score >= 4 || $this->player2Score >= 4) && abs($this->player1Score - $this->player2Score) === 1;
    }

    private function isOver(): bool
    {
        return ($this->player1Score >= 4 || $this->player2Score >= 4) && abs($this->player1Score - $this->player2Score) >= 2;
    }

    private function whoIsWinning()
    {
        if ($this->player1Score > $this->player2Score) {
            return $this->player1Name;
        }

        if ($this->player2Score > $this->player1Score) {
            return $this->player2Name;
        }

        return null;
    }

    public function getScore()
    {
        $score = "";
        if ($this->isEven()) {
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
        } elseif ($this->isPlayoff()) {
            $score = \sprintf('Advantage %s', $this->whoIsWinning());
        } elseif ($this->isOver()) {
            $score = \sprintf('Win for %s', $this->whoIsWinning());
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
