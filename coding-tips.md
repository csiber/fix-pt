### Sessions
You can use this three types of sessions for alerts

##Flash Data - store items in the session only for the next request. 

* Session::flash('info', 'Some info');
* Session::flash('success', 'Some success');
* Session::flash('warning', 'Some warning');
* Session::flash('error', 'Some error');
* Session::flash('success', array('msg 1', 'msg2', 'msg2'));
The message in the session could also be an array

##Read data from Sesssion:
{{ Session::get('warning') }}


###Users
admin admin
christopher.pitt okidoki

