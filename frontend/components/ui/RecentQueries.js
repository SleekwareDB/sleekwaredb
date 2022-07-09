import { ClockIcon, EyeIcon } from '@heroicons/react/solid'
export default function RecentQueries() {
    return (
        <>
            <div className='my-5'>
                <h2 className="text-lg font-bold">
                    <ClockIcon className="w-5 h-5 inline mr-1" />
                    Recenct Queries
                </h2>
                <div className="overflow-x-auto">
                    <table className="table table-compact w-full">
                        <thead>
                            <tr>
                                <th>Date Time</th>
                                <th>Actor</th>
                                <th>Activity</th>
                                <th>Data</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>05/03/2022 09:46:55</th>
                                <td>Russell Reyes</td>
                                <td>http://ite.mg/mid</td>
                                <td>f699ad78-de81-576d-8e67-15d62156a741</td>
                                <td>
                                    <button className="btn btn-xs btn-secondary">
                                        <EyeIcon className="w-2 h-2" />
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th>05/04/2022 16:49:49</th>
                                <td>Leah Kelly</td>
                                <td>http://rig.pk/ratvuj</td>
                                <td>829cf83d-f008-5d3c-a49f-f9c9b6c33013</td>
                                <td>
                                    <button className="btn btn-xs btn-secondary">
                                        <EyeIcon className="w-2 h-2" />
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th>17/05/2022 14:57:33</th>
                                <td>Hester Rhodes</td>
                                <td>http://ko.iq/jehokic</td>
                                <td>4b5ebd6a-8db4-5f95-8034-85fc9ead9363</td>
                                <td>
                                    <button className="btn btn-xs btn-secondary">
                                        <EyeIcon className="w-2 h-2" />
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th>11/12/2022 12:30:25</th>
                                <td>Elnora Holland</td>
                                <td>http://ozkuh.eu/jacdan</td>
                                <td>78b70bdb-586b-5622-9094-ddba53eaadfa</td>
                                <td>
                                    <button className="btn btn-xs btn-secondary">
                                        <EyeIcon className="w-2 h-2" />
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Date Time</th>
                                <th>Actor</th>
                                <th>Activity</th>
                                <th>Data</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </>
    )
}
