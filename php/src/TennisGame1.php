<?php

namespace TennisGame;

class TennisGame1 implements TennisGame
{
    private int $player1Score = 0;
    private int $player2Score = 0;

    protected const POINT_STATUS = [
        0 => 'Love',
        1 => 'Fifteen',
        2 => 'Thirty',
        3 => 'Forty'
    ];

    public function __construct(private readonly string $player1Name, private readonly string $player2Name)
    {
    }

    public function wonPoint($playerName): void
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
        return ($this->player1Score >= \count(self::POINT_STATUS) || $this->player2Score >= \count(self::POINT_STATUS)) && abs($this->player1Score - $this->player2Score) === 1;
    }

    private function isOver(): bool
    {
        return ($this->player1Score >= \count(self::POINT_STATUS) || $this->player2Score >= \count(self::POINT_STATUS)) && abs($this->player1Score - $this->player2Score) >= 2;
    }

    private function whoIsWinning(): ?string
    {
        if ($this->player1Score > $this->player2Score) {
            return $this->player1Name;
        }

        if ($this->player2Score > $this->player1Score) {
            return $this->player2Name;
        }

        return null;
    }

    public function getScore(): string
    {
        if ($this->isEven()) {
            $evenStatuses = self::POINT_STATUS;
            \array_pop($evenStatuses);
            return isset($evenStatuses[$this->player1Score]) ? \sprintf('%s-All',$evenStatuses[$this->player1Score]) : 'Deuce';
        } elseif ($this->isPlayoff()) {
            return \sprintf('Advantage %s', $this->whoIsWinning());
        } elseif ($this->isOver()) {
            return \sprintf('Win for %s', $this->whoIsWinning());
        }
        return \sprintf(
            '%s-%s',
            self::POINT_STATUS[$this->player1Score] ?? throw new \LogicException('???'),
            self::POINT_STATUS[$this->player2Score] ?? throw new \LogicException('???'),
        );
    }
}
