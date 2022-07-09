import { MenuIcon } from '@heroicons/react/outline'
import Link from 'next/link'
export default function Navbar() {
    return (
        <>
            <div className="navbar bg-base-100 fixed top-0 left-0 right-0 z-20 shadow-2xl">
                <div className="flex-none md:hidden lg:hidden">
                    <label className="btn btn-square btn-ghost drawer-button" htmlFor="my-drawer">
                        <MenuIcon className="inline-block w-6 h-6" />
                    </label>
                </div>
                <div className="flex-1">
                    <a className="btn btn-ghost normal-case text-xl">Sleekware<span className="font-extrabold text-sky-500">DB</span></a>
                </div>
                <div className="flex-none">
                    <ul className="menu menu-horizontal p-0">
                        <li><a>Anomaly <div className="badge badge-xs badge-secondary badge-outline py-2">30.2%</div></a></li>
                        <li tabIndex="0">
                            <a>
                                Alerts <div className="badge badge-xs badge-accent py-2">1</div>
                                <svg className="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" /></svg>
                            </a>
                            <ul className="p-2 bg-base-300">
                                <li><a>Submenu 1</a></li>
                                <li><a>Submenu 2</a></li>
                            </ul>
                        </li>
                        <li tabIndex="0">
                            <div className="w-16">
                                <img src="https://placeimg.com/80/80/people" className="rounded-full" />
                            </div>
                            <ul className="p-2 bg-base-300 absolute right-3">
                                <li><a>Profile</a></li>
                                <li><a>Settings</a></li>
                                <li>
                                    <Link href='/' replace>
                                        <a>Sign Out</a>
                                    </Link>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </>
    )
}
