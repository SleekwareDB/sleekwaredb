import { ViewGridIcon, CollectionIcon, ChartBarIcon } from '@heroicons/react/outline'
import { useState } from 'react'
import Link from 'next/link'

export default function Sidebar({ sideState }) {
    let [over, setOver] = useState(false)
    let hoverState = over
    let sideStateAct = (sideState || hoverState) ? 'menu z-20 drop-shadow-lg ease-in duration-300 h-screen fixed p-2 overflow-y-auto w-64 bg-base-100 text-base-content' : 'menu z-20 drop-shadow-lg ease-in duration-300 h-screen fixed p-2 overflow-y-auto w-16 bg-base-100 text-base-content sm:invisible md:visible'

    const sideHero = () => {
        return (
            <div>
                <li className="text-center normal-case text-xl font-bold">SleekwareDB</li>
                <li><span className="divider">Menu</span></li>
            </div>
        )
    }

    return (
        <>
            <ul className={sideStateAct}>
                {(sideState) ? sideHero() : ''}
                <li>
                    <Link href='/dashboard' replace>
                        <a onMouseEnter={() => setOver(true)} onMouseLeave={() => setOver(false)}>
                            <ViewGridIcon className="w-6 h-6" />
                            {(sideState || hoverState) ? 'Dashboard' : ''}
                        </a>
                    </Link>
                </li>
                <li>
                    <Link href='/collections' replace>
                        <a onMouseEnter={() => setOver(true)} onMouseLeave={() => setOver(false)}>
                            <CollectionIcon className="w-6 h-6" />
                            {(sideState || hoverState) ? 'Collections' : ''}
                        </a>
                    </Link>
                </li>
                <li>
                    <Link href='/stats' replace>
                        <a onMouseEnter={() => setOver(true)} onMouseLeave={() => setOver(false)}>
                            <ChartBarIcon className='w-6 h-6' />
                            {(sideState || hoverState) ? 'Stats' : ''}
                        </a>
                    </Link>
                </li>
            </ul>
        </>
    )
}
