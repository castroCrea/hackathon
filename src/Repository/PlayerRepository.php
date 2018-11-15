<?php
/**
 * Created by PhpStorm.
 * User: paolocastro
 * Date: 10/11/2018
 * Time: 15:50
 */

namespace App\Repository;

use App\Entity\Game;
use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class PlayerRepository
 *
 * @package App\Repository
 */
class PlayerRepository extends ServiceEntityRepository
{
    /**
     * PlayerRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Player::class);
    }

    /**
     * @param Game $game
     * @param bool|null $inUse
     * @return iterable
     */
    public function findAllByGame(Game $game, ?bool $inUse = null): iterable
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->where('p.game = :game OR p.gameMaster = :game')
            ->setParameter('game', $game);

        if (null !== $inUse) {
            $qb
            ->andWhere('p.inUse = :inUse')
            ->setParameter('inUse', $inUse);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @param Game $game
     * @param bool|null $inUse
     * @return iterable
     */
    public function findAllGamersByGame(Game $game, ?bool $inUse = null): iterable
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->where('p.game = :game')
            ->setParameter('game', $game);

        if (null !== $inUse) {
            $qb
            ->andWhere('p.inUse = :inUse')
            ->setParameter('inUse', $inUse);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @param Player $player
     */
    public function save(Player $player){
        $this->_em->persist($player);
        $this->_em->flush();
    }
}