const pkg = require('../../package.json')

export default function Version() {
    return (
        <small className='font-light m-1 text-gray-600'>~ v{pkg.version} ~</small>
    )
}
